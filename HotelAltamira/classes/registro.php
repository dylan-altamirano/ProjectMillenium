<?php

  require_once('DAO.php');

  $id = $_POST['iduser'];
  $username = $_POST['user'];
  $email = $_POST['email'];
  $pais = $_POST['cbopaises'];
  $clave = $_POST['password'];

  //Crea el usuario de los parametros obtenidos del formulario
  $usuario = new usuario();

  $usuario->setId($id);
  $usuario->setNombre($username);
  $usuario->setCorreo($email);
  $usuario->setPais($pais);
  $usuario->setRole("Cliente");
  $usuario->setPassword($clave);
  $usuario->setActivo(true);
//Fin de creacion de usuario


//crea un objeto DAO
$user_dao = new usuario_dao();
//Guardamos el objeto usuario en la base de datos
if ($user_dao->insert($usuario)) {
  echo "<script>alert('Usuario registrado con exito')</script> ";
  header('Location:../index.php');
}else{
  echo "<script>alert('Hubo un problema en el registro de tu cuenta. Por favor, vuelve a intertarlo.')</script> ";
  header('Location:../index.php');
}

 ?>
