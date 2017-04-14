<?php
    session_start();

  //Verifica que la sesión exista
  if ($_SESSION['user_name']) {
    //si existe destruye la sesión
    session_destroy();

    header('Location:../index.php'); //redirecciona a la página principal del sitio
  }


 ?>
