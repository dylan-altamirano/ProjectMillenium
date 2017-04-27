<?php require_once('classes/header.php');
      require_once('classes/DAO.php');

  //Analiza si la sesion no ha sido inicializada o si no ha habido una acción del form
  if (!isset($_SESSION['correos']) || ($_SERVER['REQUEST_METHOD'] != 'POST')) {
    //creará una nueva variable de sesión de correos
    $_SESSION['correos'] = array();
  }

  $usuario_d = new usuario_dao();

  if (isset($_POST['destinatario'])) {
       $key = $_POST['destinatario'];

          if ($usuario_d->correo_si($key)>0) {
           array_push($_SESSION['correos'],$key);
         }



  }else {
      //Traerse todos los correos
      $_SESSION['todos'] = "todos";
  }

?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Envío de correos publicitarios

                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Inicio</a>
                    </li>
                    <li class="active">Administrar correo empresarial</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="well">
          <div class="row">
           <form action="envioPublicidad.php" method="post">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="opcion-envio">Enviar a :</label>
                  <div class="dropdown">
                      <button type="button" href="#" class="dropdown-toggle form-control" data-toggle="dropdown">Destinatario<b class="caret"></b></button>
                      <ul class="dropdown-menu dropdown-menu-right form-control">

                          <li class="dropdown-item" value="Todos">
                              <a href="#" onclick="disableFieldset();">Todos</a>
                          </li>
                          <li class="dropdown-item" value="especifico">
                              <a href="#" onclick=" enableFieldset();">Usuario especifico</a>
                          </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-12">

                    <fieldset id="destinatarios" disabled>
                      <div class="form-group">
                        <label for="destinatario-correo">Recipiente</label>
                        <input type="text" id="destinatario-correo" name="destinatario" class="form-control" placeholder="Correo electrónico...">
                      </div>
                      <button type="submit" class="btn btn-primary">Agregar destinatario</button>
                    </fieldset>

              </div>
          </form>

          </div>
        </div>

        <div class="alert alert-info" id="recipientes" <?php echo (count($_SESSION['correos'])>0)?"":"hidden"?>>
          <strong>Recipientes </strong>
          <?php $correos = $_SESSION['correos'];
                foreach ($correos as $recipiente) {
                  echo $recipiente."; ";
                }
           ?>
        </div>

      <!--Another row in the lay-out-->
      <div class="well">

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <h3 class="card-header">Mensaje</h3>
              <div class="card-block">
              <!--Pequeño formulario dentro del mensaje-->
                <form class="" action="classes/enviarCorreoPublicitario.php" method="post" onsubmit=" return validateMessage();">
                  <div class="form-group">
                    <label for="cuerpo-correo"></label>
                    <textarea class="form-control" id="cuerpo-correo" name="cuerpo-correo-txt" rows="9"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </form>

              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="alert alert-warning" id="warning" hidden>
          <strong>Advertencia!</strong> No puedes enviar un mensaje en blanco.
      </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Grupo Altamira 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
      function enableFieldset(){
        document.getElementById('destinatarios').disabled=false;
      }

      function disableFieldset(){
        document.getElementById('destinatarios').disabled =true;
      }

      //Retorna si el text area contiene un mensaje a enviar
      function validateMessage(){

          var text = document.getElementById('cuerpo-correo').value;

          if (text =="") {
              document.getElementById('warning').hidden = false;
              return false;
          }else {
             document.getElementById('warning').hidden = true;
             return true;
          }

      }

    </script>

</body>

</html>
