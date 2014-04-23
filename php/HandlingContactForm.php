<?php
require_once '../lib/SecureImage/securimage.php';
include_once "../lib/Lib.php";
require_once '../lib/Utility/Mail.php';

$captcha_code        = $_POST['captcha_code'];

$securimage = new Securimage();

if ($securimage->check($captcha_code) == true) { 
  
	if (empty($_POST['email'])) {
		//puste pole email
		echo 'brak maila';
	} else { 
		//zapisz email
		$cMail=$_POST['email'];
	}
  
	if (empty($_POST['subject'])){
		//pusty temat
		echo 'brak tematu';
	} else {
		//zapisz temat
		$cSubject=$_POST['subject'];
	}
  
	if (empty($_POST['message'])){
		//pusta wiadomosc
		echo 'brak wiadomosc';
	} else {
		//zapisz wiadomosc
		$cMessage=$_PSOT['message'];
	}
  
	echo 'captcha code valid'; 
  
	//cMail - adres podany w formularzy
	//cSubject - temat podany w formularzu
	//cMessage - tresc komunikatu
	if(mailer('GUSER',$cMail,'Formularz kontaktowy',$cSubject,$cMessage,false))
		echo 'Funkcja mailer() zwrocila prawde';
		header('Location: ../index.php' ); 
} else {
	$_SESSION['formErrorCode'] = 'invalidCaptcha';
	header('Location: ../Contact.php' ); 
}
;?>
