<?php
// var_dump($_POST);
require ('PHPMailer/PHPMailerAutoload.php') ;

$from       = 'info@elitemgroup.com';
$fromName   = 'Elite M Group';
$to         = $_POST['sendEmailTo'];
//$to = 'jmunoz.comunicacion@gmail.com';
$replyTo    = 'info@elitemgroup.com';

$mail       = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP                                    // TCP port to connect to

$mail->From = $from;
$mail->FromName = $fromName;
$mail->addAddress($to, 'Info');     // Add a recipient             // Name is optional
$mail->addReplyTo($replyTo, 'Info from Elite M Group');
$mail->addBCC('raul@wheretogo.com.mx');
$mail->addBCC('info@elitemgroup.com');


$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $_POST['sendEmailSubject'];
$mail->Body    = $_POST['sendEmailContent'];


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'success';
}