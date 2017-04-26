<?php require_once('classes/funciones.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hotel Altamira</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/signinstyles.css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Navigation of the website-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Hotel Altamira</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="about.php">Acerca</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Galería <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="portfolio-4-col.php">Imagénes del hotel</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="contact.php">Contáctenos</a>
                    </li>
                    <?php
                          if (isset($_SESSION['user_name'])) {
                            require_once('classes/estadousuario.php');
                          }else{
                            require_once('classes/usuario_no.php');
                          }
                     ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!--MODAL WINDOW FOR SIGN-IN PROCESS-->
    <div id="signIn"class="modal fade" role="dialog">

      <div class="modal-dialog">

        <!--Modal content-->
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" name="close-window">&times;</button>
            <h4><p>Accede a tu cuenta</p></h4>

        </div>

          <div class="modal-body">
          <!--<div class="container">-->
              <div class="row">

                <div class="col-md-12 col-md-offset-0">
                  <div class="panel panel-login">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-6">
                          <a href="#" class="active" id="login-form-link">Entra</a>
                        </div>
                        <div class="col-xs-6">
                          <a href="#" id="register-form-link">Regístrate</a>
                        </div>
                      </div>
                      <hr>
                    </div>

                </div>
              </div>

          					<div class="panel-body">
          						<div class="row">
          							<div class="col-lg-12">
          								<form id="login-form" action="./classes/login.php" method="post" role="form" style="display: block;">
          									<div class="form-group">
          										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Nombre de usuario" value="">
          									</div>
          									<div class="form-group">
          										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña">
          									</div>
          									<div class="form-group text-center">
          										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
          										<label for="remember"> Mantenerme conectado</label>
          									</div>
          									<div class="form-group">
          										<div class="row">
          											<div class="col-sm-6 col-sm-offset-3">
          												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
          											</div>
          										</div>
          									</div>
          									<div class="form-group">
          										<div class="row">
          											<div class="col-lg-12">
          												<div class="text-center">
          													<a href="" tabindex="5" class="forgot-password">Olvidaste tu contraseña?</a>
          												</div>
          											</div>
          										</div>
          									</div>
          								</form>
          								<form id="register-form" action="classes/registro.php" method="post" onsubmit="return validarRegistro();" role="form" style="display: none;">
                            <div class="form-group">
          										<input type="text" name="iduser" id="id_user" tabindex="1" class="form-control" placeholder="Identificación" value="">
          									</div>
                            <div class="form-group">
          										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Nombre de usuario" value="">
          									</div>
          									<div class="form-group">
          										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo electrónico" value="">
          									</div>
                            <div class="form-group">
                              <label for="cbopaises">Elije tu país: </label>
          									    <select class="form-control" name="cbopaises" tabindex="1">
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="US">Estados Unidos</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="España">España</option>
                                    <option value="Otro">Otro</option>
          									    </select>
          									</div>
          									<div class="form-group">
          										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña">
          									</div>
          									<div class="form-group">
          										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirmar contraseña">
          									</div>
          									<div class="form-group">
          										<div class="row">
          											<div class="col-sm-6 col-sm-offset-3">
          												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrarse ahora">
          											</div>
          										</div>
          									</div>
          								</form>
          							</div>
          						</div>
          					</div>
          				</div>
          			</div>
          		</div>
          <!--</div>-->


          </div>

        </div>

      </div>

    </div> <!--FIN DEL FORMUALRIO DE LOGIN-->

    <script type="text/javascript">

      function validarRegistro(){
        var id = document.getElementById('id_user').value;
        var nombre = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var pass = document.getElementById('password').value;
        var pass_con = document.getElementById('confirm-password').value;

        if (id=="" || nombre =="" || email=="" || pass=="" || pass_con=="") {
          alert('Tienes que ingresar datos válidos en el formulario');
          return false;
        }else{
          return true;
        }

      }
      </script>
