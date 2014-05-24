<?php
	
	include_once("../lib/Lib.php");
	
	if (isset($_POST['submitActivationCodeButton']) 
		&& isset($_POST['activationCode']) 
		&& $_POST['activationCode'] == Settings::getAuthorizationCode()  
		) { 
		
		header('Location: ../RegisterForm.php' ); 
	} else {
		
		$_SESSION['activationCodeFormErrorCode'] = 'invalidActivationCode';
		header('Location: ../InsertActivationCode.php'); 
	}
	
?>
