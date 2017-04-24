<?php

require_once('PHPMailer/PHPMailerAutoload.php');

function send_mail($correo,$estado,$reservacion){



  $habitaciones = $reservacion->getHabitaciones();
  $cadena_habitaciones="";

  foreach ($habitaciones as $habitacion) {
    $cadena_habitaciones .= "Habitacion: ".$habitacion->getID()."<br>
    Tipo: ".$habitacion->getTipo()."<br>
    <hr><br>";
  }

  //Crear email
  $mail = new PHPMailer;

  //$mail->SMTPDebug=2;
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'hotelaltamiracr@gmail.com';                 // SMTP username
  $mail->Password = 'CieloDylan';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  $mail->setFrom('hotelaltamiracr@gmail.com', 'Hotel Altamira');
  //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
  $mail->addAddress($correo);               // Name is optional
//  $mail->addReplyTo('info@example.com', 'Information');
//  $mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

//  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = "Tu ".$estado."  con Hotel Altamira";
  $mail->Body    = "<!DOCTYPE html>
  <html>
    <head>
      <title>".$estado."</title>
      <meta charset='utf-8'>
    </head>
    <body style='font-family: arial; background-color: #f0f0f5;'>
      <table>
        <tr>
          <td align='center' style='background-color: #ffccb3; padding: 2px;'> <b>".$estado." de habitacion</b></td>
        </tr>
        <tr>
          <td>
            <br>
            Nº Factura: ".$reservacion->getID()."<br>
            Cliente: ".$reservacion->getUsuario()->getNombre()."<br>
            Fecha Inicio: ".$reservacion->getFechaIni()."<br>
            Fecha Final: ".$reservacion->getFechaFin()."<br> <br>
            <hr>

            ".$cadena_habitaciones."
          </td>
        </tr>
        <tr align='center' style='background-color: #ffccb3; padding: 2px;'>
          <td><b>Precio Final:".$reservacion->calcularPrecio()." USD</b>
          </td>
        </tr>
        <tr style='background-color: #ffccb3; padding: 2px;'>
          <td><br><small>Copyrights all reserved by Hotel Altamira 2017</small> </td>
        </tr>
      </table>
    </body>
  </html>
";
//  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      return false;
  } else {
      return true;

  }

}

 ?>
