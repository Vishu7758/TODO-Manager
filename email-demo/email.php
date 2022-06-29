<?php 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'vendor/autoload.php'; 

$mail = new PHPMailer(true); 

try { 
	$mail->SMTPDebug = 2;									 
	$mail->isSMTP();											 
	$mail->Host	 = 'smtp.gmail.com;';					 
	$mail->SMTPAuth = true;							 
	$mail->Username = 'dktetodo.project@gmail.com';
	$mail->Password = 'dkte1234';
	
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	 = 587; 

	//$mail->setFrom('asshelar@dktes.com', 'Alankar Shelar');		 
	//$mail->addAddress('alankarshelar5620@gmail.com'); 
	//$mail->addAddress('alankarshelar89@gmail.com', 'AS'); 
	
		//From email address and name
		$mail->From = "dktetodo.project@gmail.com";
		$mail->FromName = "Vishal Kharade";

		//To address and name
		$mailId = $_GET['email'];
		$mail->addAddress("$mailId", "New User");
		// $mail->addAddress("akshatakhot18@gmail.com","student...."); //Recipient name is optional

		//Address to which recipient will reply
		$mail->addReplyTo("dktetodo.project@gmail.com", "Reply");

		//CC and BCC
		//$mail->addCC("cc@example.com");
		//$mail->addBCC("bcc@example.com");
	
	//    $mail->addAttachment("img1.jpg");
	
	$mail->isHTML(true);								 
	$mail->Subject = 'Registeration Successfull'; 
	$mail->Body = 'Congratulations, You succesfully registered on our TODO Portal';//, <br><strong>Congratulations, you successully registered on our TODO Portal</strong><br><strong><i>Welcome to the family.</i></strong>'; 
	$mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
	$mail->send();

	// echo "Mail has been sent successfully!";
	header('location:../signup/success-validation.php');
} 
catch (Exception $e) 
{ 
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
}
?>