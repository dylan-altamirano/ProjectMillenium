<?php

  require_once('DAO.php');
  require_once('PHPMailer/PHPMailerAutoload.php');

  session_start();

  $correos = $_SESSION['correos'];
  $todos = $_SESSION['todos'];
  $mensaje = $_POST['cuerpo-correo-txt'];

  $array_correos = new ArrayObject();

  $usuario_d = new usuario_dao();

  if (count($correos)>0) {

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
    foreach ($correos as $value) {
      $mail->addAddress($value);
    }

                  // Name is optional
  //  $mail->addReplyTo('info@example.com', 'Information');
  //  $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Aviso de Administrador Hotel altamira";
    $mail->Body    = "<!DOCTYPE html>
    <html>
      <head>
        <title>Administrador</title>
        <meta charset='utf-8'>
      </head>
      <body style='font-family: arial; background-color: #f0f0f5;'>
        <table>
          <tr>
            <td align='center' style='background-color: #ffccb3; padding: 2px;'> <b>Mensaje de admin</b></td>
          </tr>
          <tr>
            <td>".$mensaje."</td>
          </tr>
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
      //destruye la variable en cuestion
      unset($_SESSION['correos']);
      header("refresh:0; url=../envioPublicidad.php");
      echo "<script> alert('Correo no enviado'); </script>";
    } else {
      //destruye la variable en cuestion
      unset($_SESSION['correos']);
      header("refresh:0; url=../envioPublicidad.php");
      echo "<script> alert('Correo enviado'); </script>";

    }

  }else {
    $array_correos =$usuario_d->select_emails();

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
    foreach ($array_correos as $value) {
      $mail->addAddress($value);
    }

                  // Name is optional
  //  $mail->addReplyTo('info@example.com', 'Information');
  //  $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Aviso de Administrador Hotel altamira";
    $mail->Body    = "<!DOCTYPE html>
    <html>
      <head>
        <title>Administrador</title>
        <meta charset='utf-8'>
      </head>
      <body style='font-family: arial; background-color: #f0f0f5;'>
        <table>
          <tr>
            <td align='center' style='background-color: #ffccb3; padding: 2px;'> <b>Mensaje de admin</b></td>
          </tr>
          <tr>
            <td>".$mensaje."</td>
          </tr>
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
      //destruye la variable en cuestion
      unset($_SESSION['correos']);
      header("refresh:0; url=../envioPublicidad.php");
      echo "<script> alert('Correo no enviado'); </script>";
    } else {
      //destruye la variable en cuestion
      unset($_SESSION['correos']);
      header("refresh:0; url=../envioPublicidad.php");
      echo "<script> alert('Correo enviado'); </script>";

    }

  }


 ?>
