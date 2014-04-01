<?php

require_once 'lib/SecureImage/securimage.php';
include_once("lib/Lib.php");
 

//var_dump (isset($_POST['submitButton'])) ; 

if (isset($_POST['submitButton']) == false) {
	//echo "przekierowanie poszło" ; 
	$_SESSION['email'] = ""    ;
	$_SESSION['gender'] = ""  ;
	$_SESSION['name'] = ""   ;
	$_SESSION['surname'] = "" ;
	header('Location: RegisterForm.php' ); 
} 
else {
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
		$user->setActivationCode(md5(microtime()));
		//$user->setName($_POST['name']);
		
		if (UserDatabase::addUser($user)) { 
			$_SESSION['formSuccessCode'] = TRUE ; 

			$headers    = array
    		(
		        'MIME-Version: 1.0',
		        'Content-Type: text/html; charset="UTF-8";',
		        'Content-Transfer-Encoding: 7bit',
		        'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
		        'From: ' . 'pz-exams@pz-exams.com',
		        'X-Mailer: PHP v' . phpversion(),
		        'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
	    	);
		
			mail($user->getEmail(), 'Aktywacja konta na pz-exams', 
			"Witaj,<br/><br/>
			aby aktywować swoje konto kliknij w poniższy link:<br/><br/>
			<a href=\"http://localhost/index.php?email=" . $user->getEmail() . "&code=" . $user->getActivationCode() . "\">Aktywuj</a><br/>
			__________<br/>
			- pz-exams
			"
			, implode("\n", $headers));

			header('Location: index.php' );
		} else { 
			// echo "Użytkownika nie udało sie wprowadzić do bazy ";
			$_SESSION['formErrorCode'] = 'userAlreadyInDB';
			header('Location: RegisterForm.php' );
		} 
			
		echo 'captcha code valid'; 
	} else {
		$_SESSION['formErrorCode'] = 'invalidCaptcha';
		header('Location: RegisterForm.php' ); 
	}
}
?>

