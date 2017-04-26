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
  $clave = $_POST['passwordA'];

  //Crea el usuario de los parametros obtenidos del formulario

  
  $usuario->setNombre($username);
 
  $usuario->setPais($pais);
  
  $usuario->setPassword($clave);
  

$usuario_d->update($usuario);

echo "actualizacion creada";
  

 ?>