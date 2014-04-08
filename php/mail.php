<?php

require '../lib/Mail/PHPMailerAutoload.php';

define('GUSER', 'pz.exams@gmail.com');
define('GPWD', 'optymalnehaslo1337');

function mailer($to, $from, $from_name, $subject, $body, $isHTML) {
//Jako pierwszy argument można podac jednego adresata, lub tablice

	global $error;
	$mail = new PHPMailer();

	if (gettype($to) == 'array')
	{
		foreach ($to as $address)
		{
			$mail->AddAddress($address);
		}
	}
	else
	{
		$mail->AddAddress($to);
	}

	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;          
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->IsHTML($isHTML);
	$mail->CharSet = 'UTF-8';

	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		//echo 'Error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message sent!';
		//echo 'Poszlo';
		return true;
	}
}

?>
