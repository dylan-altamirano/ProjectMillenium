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

if ($user_dao->correo_si($email)>0) {
  header("refresh:0; url=../index.php");
  echo "<script>alert('Al parecer ya existe un usuario con el mismo correo electrónico. Vuelve a intentarlo.')</script> ";

}else{
  //Guardamos el objeto usuario en la base de datos
  if ($user_dao->insert($usuario)) {
    header("refresh:0; url=../index.php");
    echo "<script>alert('Usuario registrado con exito')</script> ";
    //header('Location:../index.php');
  }else{
    header("refresh:0; url=../index.php");
    echo "<script>alert('Hubo un problema en el registro de tu cuenta. Por favor, vuelve a intertarlo.')</script> ";
    //header('Location:../index.php');
  }
}


 ?>
