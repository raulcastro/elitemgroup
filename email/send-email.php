<?php
// var_dump($_POST);
$root = $_SERVER['DOCUMENT_ROOT'];
require ('PHPMailer/PHPMailerAutoload.php');
date_default_timezone_set('America/Toronto');
require_once($root.'/models/back/Layout_Model.php');
require_once($root.'/views/Layout_View.php');
require_once $root.'/backends/admin-backend.php';
require_once $root.'/Framework/Tools.php';
$model	= new Layout_Model();

$from       = 'info@elitemgroup.com';
$fromName   = 'Elite M Group';
$to         = $_POST['sendEmailTo'];
$replyTo    = 'info@elitemgroup.com';

$mail       = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP                                    // TCP port to connect to

$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth   	= true;                  // enable SMTP authentication
$mail->SMTPSecure 	= "ssl";                 // sets the prefix to the servier
$mail->Host       	= "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       	= 465;                   // set the SMTP port for the GMAIL server
$mail->Username   	= "wtg.sender@gmail.com";  // GMAIL username
$mail->Password   	= "cas8867ca";            // GMAIL password
$mail->CharSet 		= 'utf-8';
$mail->From 		= $from;
$mail->FromName 	= $fromName;
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