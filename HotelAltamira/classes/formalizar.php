<?php
//require_once('classes/PHPMailer/PHPMailerAutoload.php');
require_once('DAO.php');
require_once('SendMail.php');

session_start();

$correo = $_SESSION['correo'];
$reserv = $_SESSION['reservacion'];

$reservacion_b = new reservacion_dao();

if (send_mail($correo,"Factura",$reserv)) {
  //$reserv->setEstado("Facturado");
  //$reservacion_b->update($reserv);
  echo "<script> alert('Reservacion se ha actualizado con exito'); </script>";

  $reserv->setEstado("Facturado");
  $reservacion_b->update($reserv);

    if ($reserv->getEstado()=="Facturado") {
       $reservacion_b->guardarHabitaciones($reserv);

       header("refresh:0;url=../index.php");
       echo "<script> alert('Reservacion completa. Se le ha enviado la factura al correo electronico. Gracias por preferirnos'); </script>";
  }


}


?>
