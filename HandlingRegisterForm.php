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
	
	if (empty($_POST['name'])) { 
		$user->setFirstName(null);
		//echo "imie puste <br />" ;
	} else { 
		$user->setFirstName($_POST['name']);
	}
	
	if (empty($_POST['surname'])) { 
		$user->setSurname(null);
		//echo "nazwisko puste <br /> " ; 
	} else { 
		$user->setSurname($_POST['surname']);
	} 
	
	if ($_POST['gender']  == "- Wybierz płeć -") { 
		$user->setGender(null);
		//echo "płeć pusta <br />" ;
	} else {
		//echo "płeć nie pusta " . $_POST['gender'] .  " <br />" ;
		( $_POST['gender'] == "Kobieta" ) ? $user->setGender("female") : $user->setGender("male") ;
	} 
	
	$user->setEmail($_POST['email']);
	$user->setPassword ($_POST['passwd']);
	//$user->setName($_POST['name']);
	if ( UserDatabase::checkActivated($user) ) { 
		$_GET['formErrorCode'] = 'userAlreadyInDB';
		header('Location: RegisterForm.php?'. http_build_query($_GET) );
	} 
	
	if (UserDatabase::addUser($user)) { 
		echo "Użytkownik wprowadzony do bazy poprawnie"; 
	} else { 
		// echo "Użytkownika nie udało sie wprowadzić do bazy ";
		$_GET['formErrorCode'] = 'userAlreadyInDB';
		header('Location: RegisterForm.php?'. http_build_query($_GET) );
	} 
		
	echo 'captcha code valid'; 
} else {
	$_GET['formErrorCode'] = 'invalidCaptcha';
	header('Location: RegisterForm.php?'. http_build_query($_GET) ); 
}

?>

