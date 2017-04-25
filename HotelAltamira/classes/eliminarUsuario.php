<?php
  require_once('DAO.php');

  $usuario_a = new usuario_dao();
  $usuario = new usuario();

  if (isset($_GET['id'])) {
    $user_key = $_GET['id'];

    $usuario = $usuario_a->delete($user_key);

    header("refresh:0; url=../adminUsers.php");
    echo "<script> alert('Usuario correctamente eliminado'); </script>";
  }


 ?>
