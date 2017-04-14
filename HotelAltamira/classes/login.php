<?php
  require_once("DAO.php");

  $email = $_POST['username'];
  $clave = $_POST['password'];

  $usuario_dao = new usuario_dao();

  if ($usuario_dao->autenticar($email,$clave)) {
    header('Location:../index2.php');
  }else{
    header('Location:../index.php');
  }
 ?>
