<?php
  require_once('classes/header.php');
  require_once('classes/DAO.php');
  require_once('classes/PHPMailer/PHPMailerAutoload.php');


  //session_start();

  if (isset($_POST['optionRooms'])) {



  $user_key= $_SESSION['user_name'];
  $habitacion= $_POST['optionRooms'];
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


  $_SESSION['reservacion'] =$reservacion;
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

  //carga lo demas
  require_once('classes/reservacionConfirmacion.php');
//Fin de la confirmacion de existencia de la variable de los radio buttons
}else{
    echo "<script> locatiion.replace('pricing.php');</script>";
}
 ?>
