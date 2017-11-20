<?php


$email= "jordi.reixach@newronia.com";
$subject = "asdd";
$cos = "asd";

require 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'reixacu@gmail.com';                 // SMTP username
$mail->Password = 'rbimtohaypjbkmjw';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 25;

$mail->From = 'reixacu@gmail.com';
$mail->FromName = 'Maqfa';
$mail->addAddress($email);     // Add a recipient

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $cos;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'No s\'ha pogut enviar el missatge.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Missatge enviat correctament';
}


 ?>
