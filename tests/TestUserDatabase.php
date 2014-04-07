<?php
	include("TestBegin.php");
	
	include_once('../lib/Lib.php');
	
	$user = UserDatabase::getUser(1);
	if ($user == null) {
		echo "Następujący test zakończył się niepowodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
		echo DatabaseConnector::getLastError();
	}
	else {
		if ( $user->getEmail() == "test@uj.edu.pl"   ) {  
			echo "Następujący test zakończył się powodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
		} else { 
			echo "Następujący test zakończył się niepowodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
		}
	}
	
	if (UserDatabase::updateUserPassword($user, 'test12')){
	    $user->setPassword('test12');
		echo $user->getPassword();
	}else{
		echo "Nope";
	}
	
	include("TestEnd.php");
	
?>