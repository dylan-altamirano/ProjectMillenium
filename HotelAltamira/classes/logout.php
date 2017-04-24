<?php
//  require_once('classes/funciones.php');

  session_start();

  if (isset($_SESSION['user_name'])) {
    header('refresh:0;url=../index.php');
    session_destroy();
  }

 ?>
