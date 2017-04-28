<?php

  require_once('DAO.php');

  session_start();

	$usuario_d = new usuario_dao();

	$email = $_SESSION['user_name'];

  $usuario = new usuario();
  $usuario = $usuario_d->select($email);

 // var_dump($email);



  $username = $_POST['username'];
  $pais = $_POST['cbopaises'];
  $clave_actual = $_POST['password'];
  $clave = $_POST['passwordA'];

  //Crea el usuario de los parametros obtenidos del formulario


  $usuario->setNombre($username);

  $usuario->setPais($pais);

  $usuario->setPassword($clave);

  if ($usuario_d->autenticar_por_clave($email,$clave_actual)) {

    $usuario_d->update($usuario);

    header("refresh:0; url=../index.php");
    echo "<script>alert('Usuario actualizado con exito')</script> ";
  }else{
    header("refresh:0; url=../index.php");
    echo "<script>alert('Clave actual incorrecta, no puedes actualizar sin autenticacion. Intentalo de nuevo.')</script> ";
  }






 ?>
