<?php
  require_once('classes/header.php');
  require_once('classes/DAO.php');
  require_once('classes/PHPMailer/PHPMailerAutoload.php');


  //session_start();

  $user_key= $_SESSION['user_name'];
  $habitacion = $_POST['optionRooms'];
  $fecha_ini= $_POST['fecha-inicial'];
  $fecha_fin =$_POST['fecha-final'];

  $usuario = new usuario();
  $usuario_dao = new usuario_dao();

  //var_dump($user_key);
  $usuario = $usuario_dao->select($user_key);

  //Crea un objeto dao del objeto reservacion
  $reservacion_a = new reservacion_dao();
  //Obtiene los cuartos que están reservados en la base de datos para tener un rango
  $bookings = $reservacion_a->getBookedRooms();

  //crea una nueva reservacion en el sistema
  $reservacion = new reservacion();

  //Creamos un nuevo id para la reservacion
  $id = intval($reservacion_a->getLastID());
  //Incrementamos el valor del id
  $id++;
  //Lo guardamos con el nuevo id creado a partir del anterior
  $reservacion->setId($id);
  //Proporciona los datos listos para hacer de la reservacion un proceso a realizar
  $reservacion->setFechaIni($fecha_ini);
  $reservacion->setFechaFin($fecha_fin);
  $reservacion->setUsuario($usuario);
  $reservacion->get_array_Bookings_from_database($bookings);
  $reservacion->get_array_all_rooms_by_type($reservacion_a->getRooms($habitacion));

  //Reservar habitacion
  $reservacion->reservarHabitacion();
  //Obtener y recorrer las habitaciones para efectos de mostrarlo en pantalla
  $habitaciones = $reservacion->getHabitaciones();
  $cadena_habitaciones="";

  foreach ($habitaciones as $habitacion) {
    $cadena_habitaciones .= "Habitacion: ".$habitacion->getID()."<br>
    Tipo: ".$habitacion->getTipo()."<br>
    <hr><br>";
  }

  //var_dump($cadena_habitaciones);

  //Establece la reservacion como cotizacion primero
  $reservacion->setEstado("Cotizado");
  //calcula el precio de la reservacion
  $reservacion->calcularPrecio();


  $_SESSION['reservacion'] =$reservacion;;
  $_SESSION['correo'] = $user_key;

  //Crear email
  $mail = new PHPMailer;

  //$mail->SMTPDebug=2;
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'hotelaltamiracr@gmail.com';                 // SMTP username
  $mail->Password = 'CieloDylan';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  $mail->setFrom('hotelaltamiracr@gmail.com', 'Hotel Altamira');
  //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
  $mail->addAddress($usuario->getCorreo());               // Name is optional
//  $mail->addReplyTo('info@example.com', 'Information');
//  $mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

//  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Tu cotizacion con Hotel Altamira';
  $mail->Body    = "<!DOCTYPE html>
  <html>
    <head>
      <title>Cotización</title>
      <meta charset='utf-8'>
    </head>
    <body style='font-family: arial; background-color: #f0f0f5;'>
      <table>
        <tr>
          <td align='center' style='background-color: #ffccb3; padding: 2px;'> <b>Cotizacion de habitacion</b></td>
        </tr>
        <tr>
          <td>
            <br>
            Nº Factura: ".$reservacion->getID()."<br>
            Cliente: ".$usuario->getNombre()."<br>
            Fecha Inicio: ".$reservacion->getFechaIni()."<br>
            Fecha Final: ".$reservacion->getFechaFin()."<br> <br>
            <hr>

            ".$cadena_habitaciones."
          </td>
        </tr>
        <tr align='center' style='background-color: #ffccb3; padding: 2px;'>
          <td><b>Precio Final:".$reservacion->calcularPrecio()." USD</b>
          </td>
        </tr>
        <tr style='background-color: #ffccb3; padding: 2px;'>
          <td><br><small>Copyrights all reserved by Hotel Altamira 2017</small> </td>
        </tr>
      </table>
    </body>
  </html>
";
//  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      echo "<script> alert('Message could not be sent'); </script>";
      echo "<script> alert('Mailer Error: $mail->ErrorInfo'); </script>";
  } else {
      echo "<script> alert('La cotización ha sido enviada a tu correo electrónico.'); </script>";

      //Adelante y guarda el documento en la base de datos
      $reservacion_a->insert($reservacion);
      echo "<script> alert('La cotización ha sido guardada en nuestra base de datos.'); </script>";

  }

 ?>

     <!-- Page Content -->
     <div class="container">

         <!-- Page Heading/Breadcrumbs -->
         <div class="row">
             <div class="col-lg-12">
                 <h1 class="page-header">Reservación
                     <small>Fácil y rápido</small>
                 </h1>
                 <ol class="breadcrumb">
                     <li><a href="index.php">Inicio</a>
                     </li>
                     <li class="active">Reservacion</li>
                 </ol>
             </div>
         </div>
         <!-- /.row -->

         <!-- Content Row -->
         <div class="row">
             <div class="col-sm-8">


                 <div class="panel-group">
                   <div class="panel panel-success">
                       <div class="panel-heading">
                         <b>Cotización de habitación</b>
                       </div>
                      <div class="panel-body">
                        <table class="table">
                          <tr>
                            <td>
                              <br>
                              Nº Factura: <?php echo $reservacion->getID(); ?><br>
                              Cliente: <?php echo  $usuario->getNombre();?><br>
                              Fecha Inicio: <?php echo $reservacion->getFechaIni();?><br>
                              Fecha Final: <?php echo $reservacion->getFechaFin()?><br> <br>
                            </td>
                          </tr>
                          <tr>
                            <td>
                               <?php foreach ($habitaciones as $habitacion) {
                                 echo "Habitacion: ".$habitacion->getID()."<br>";
                                 echo "Tipo: ".$habitacion->getTipo()."<br>";
                               } ?>

                            </td>
                          </tr>
                          <tr align="right">
                            <td><b>Precio Final: <?php echo $reservacion->calcularPrecio()." USD";?></b>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="panel-footer">
                        <small>**Tenga en cuenta que para hacer efectiva su reservación, tiene que continuar con el proceso.</small>
                      </div>
                    </div>
                 </div>


             </div>
             <form class="" action="classes/formalizar.php" method="post" name="enviar-reservacion">
               <div class="col-sm-4">
                 <div class="panel-group">
                   <div class="panel panel-success">
                     <div class="panel-body">
                       <div class="form-group">
                              <label class="control-label">Terms of use</label>
                              <div class="">
                                  <div style="border: 1px solid #e5e5e5; height: 200px; overflow: auto; padding: 10px;">
                                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
                                      <p>Mea ea nonumy labores lobortis, duo quaestio antiopam inimicus et. Ea natum solet iisque quo, prodesset mnesarchum ne vim. Sonet detraxit temporibus no has. Omnium blandit in vim, mea at omnium oblique.</p>
                                      <p>Eum ea quidam oportere imperdiet, facer oportere vituperatoribus eu vix, mea ei iisque legendos hendrerit. Blandit comprehensam eu his, ad eros veniam ridens eum. Id odio lobortis elaboraret pro. Vix te fabulas partiendo.</p>
                                      <p>Natum oportere et qui, vis graeco tincidunt instructior an, autem elitr noster per et. Mea eu mundi qualisque. Quo nemore nusquam vituperata et, mea ut abhorreant deseruisse, cu nostrud postulant dissentias qui. Postea tincidunt vel eu.</p>
                                      <p>Ad eos alia inermis nominavi, eum nibh docendi definitionem no. Ius eu stet mucius nonumes, no mea facilis philosophia necessitatibus. Te eam vidit iisque legendos, vero meliore deserunt ius ea. An qui inimicus inciderint.</p>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="agree" value="agree" /> Agree with the terms and conditions
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="">
                                  <button type="submit" class="btn btn-primary" name="reservar" value="">Reservar</button>
                                  <button type="reset" class="btn btn-primary" name="cancelar" value="" onclick="document.location.href='index.php'">Terminar</button>
                              </div>
                          </div>
                     </div>
                   </div>
                 </div>
               </div>
             </form>

         </div>
         <!-- /.row -->

         <hr>

         <!-- Footer -->
         <footer>
             <div class="row">
                 <div class="col-lg-12">
                     <p>Copyright &copy; Hotel Altamira 2017</p>
                 </div>
             </div>
         </footer>

     </div>
     <!-- /.container -->

     <!-- jQuery -->
     <script src="js/jquery.js"></script>

     <!-- Bootstrap Core JavaScript -->
     <script src="js/bootstrap.min.js"></script>

 </body>

 </html>
