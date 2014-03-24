<?php
session_start();
require_once 'lib/SecureImage/securimage.php';
$_SESSION['email'] = $_POST['email'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['surname'] = $_POST['surname'];
$captcha_code = $_POST['captcha_code'];

$securimage = new Securimage();

if ($securimage->check($captcha_code) == true) { 

	echo 'captcha code valid' ; 
} else {
	$_SESSION['captchaInvalidValue'] = true ; 
	// echo 'captcha code invalid' ;
	header('Location: register_form.php'); 
}


?>