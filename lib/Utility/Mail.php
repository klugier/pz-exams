<?php
	include_once("Mail/PHPMailerAutoload.php");

	define('GUSER', 'pz.exams@gmail.com');
	define('GPWD', 'optymalnehaslo1337');

	/***
	 * Jako pierwszy argument można podac jednego adresata, lub tablice
	 * bool $isHTML - czy tresc e-maila ($body) zawiera znaczniki HTML,
	 * ktore maja zostac sparsowane.
	 */
	function mailer($to, $from, $from_name, $subject, $body, $isHTML) {
		global $error;
		$mail = new PHPMailer();
		
		if (gettype($to) == 'array') {
			foreach ($to as $address) {
				$mail->AddAddress($address);
			}
		} else {
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
			$error = 'Mail error: ' . $mail->ErrorInfo; 
			//tutaj bedzie dostepny kod bledu
			$_SESSION['mailerErrorInfo']=$mail->ErrorInfo;
			//die('Error: '.$mail->ErrorInfo);
			return false;
		} else {
			$error = 'Message sent!';
			// echo 'Poszlo';
			//die('OK');
			return true;
		}
	}
	
?>
