<?php


$email= $_POST["destinatari"];
$subject = $_POST["assumpte"];
$cos = $_POST["cos"];
$idFactura = $_POST["id"];
$ruta = '/home/pi/factures/albara_' . $idFactura . '.pdf';
echo $ruta;
require('mailer/PHPMailerAutoload.php');

$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'xevifaco@maqfa.cat';                 // SMTP username
$mail->Password = 'rwfnswihxegprtmg';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 25;

$mail->From = 'xevifaco@maqfa.cat';
$mail->FromName = 'Maqfa';
$mail->addAddress($email);     // Add a recipient
$mail->addBCC('reixacu@gmail.com');
$mail->addBCC('xevifaco@maqfa.cat');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->addAttachment($ruta);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$headers = "Content-Type: text/html; charset=UTF-8";

$mail->Subject = $subject;
$mail->Body    = $cos;

$mail->AddEmbeddedImage('logo.jpg', 'logo');
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'No s\'ha pogut enviar el missatge.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {

  include "mysql.php";
  $sql = "UPDATE `albarans` SET `mail_enviat_factura` = 1 WHERE `albarans`.`id_factura` = '$idFactura'";
  if ($conn->query($sql) === TRUE) {
      echo "bdok";
  } else {
      echo "ERROR: " . $sql . "<br>" . $conn->error;

  }
  echo "
                          <script>
                          window.location.replace(\"mostrarAlbara.php?id=".$idFactura."\");
                          </script>
                          ";
}


 ?>
