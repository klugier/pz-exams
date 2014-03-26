<?php

require_once 'lib/SecureImage/securimage.php';
include_once("lib/Lib.php");

$_SESSION['email']   = $_POST['email'];
$_SESSION['gender']  = $_POST['gender'];
$_SESSION['name']    = $_POST['name'];
$_SESSION['surname'] = $_POST['surname'];
$captcha_code        = $_POST['captcha_code'];

$securimage = new Securimage();

if ($securimage->check($captcha_code) == true) { 
	$user = new User();
	
	$user->setEmail($_POST['email']);
	$user->setPassword ($_POST['passwd']);
	$user->setName($_POST['name']);
	
	if (UserDatabase::addUser($user)) { 
		echo "Użytkownik wprowadzony do bazy poprawnie"; 
	} else { 
		echo "Użytkownika nie udało sie wprowadzić do bazy "; 
	} 
		
	echo 'captcha code valid'; 
} else {
	$_SESSION['captchaInvalidValue'] = true;
	header('Location: register_form.php'); 
}

?>
