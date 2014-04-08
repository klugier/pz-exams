<?php
    
    include_once("../lib/Lib.php");
    
    if (isset($_POST['clearButton']) == false) {
        //echo "przekierowanie poszło" ;
        $_SESSION['passwd-old'] = ""  ;
        $_SESSION['passwd'] = ""  ;
        $_SESSION['passwd-repeat'] = ""  ;
        $_SESSION['gender'] = ""  ;
        $_SESSION['name'] = ""   ;
        $_SESSION['surname'] = "";
        header('Location: ../UserEdit.php' ); 
    }

    if (isset($_POST['submitButtonPassword']) == true) {
        
        $user = unserialize($_SESSION['USER']);
        $user = UserDatabase::getUser($user->getID());
        if( $user->getPassword() !=  sha1($_POST['passwd-old'])){// Check if present passord is correct
            $_SESSION['formErrorCode'] = 'passwordIncorrect';
        }else{
            if (UserDatabase::updateUserPassword($user, sha1($_POST['passwd']))) { 
                $_SESSION['formSuccessCode'] = 'passwordChanged';
                $user->setPassword($_POST['passwd']);
            }else {
			    $_SESSION['formErrorCode'] = 'databaseError';
		    }
        }
        header('Location: ../UserEdit.php' ); 
    }

    if (isset($_POST['submitButton']) == true) {
        $user = unserialize($_SESSION['USER']);
        $user2 = UserDatabase::getUser($user->getID());
        $user = UserDatabase::getUser($user->getID());
        
        if($_POST['name'] != $user->getFirstName()){
	    $_SESSION['name']    = $_POST['name'];
        if (UserDatabase::updateUserFirstName($user, $_SESSION['name'])) { 
            $_SESSION['formSuccessCode1'] = 'nameChanged';
        }else {
			$_SESSION['formErrorCode'] = 'databaseError';
		}}
        
        if($_POST['surname'] != $user->getSurname()){
        $_SESSION['surname'] = $_POST['surname'];
        if (UserDatabase::updateUserSurname($user, $_SESSION['surname'])) { 
            $_SESSION['formSuccessCode2'] = 'surnameChanged';
        }else {
			$_SESSION['formErrorCode'] = 'databaseError';
		}}
        
        
        ( $_POST['gender'] == "Kobieta" ) ? $user2->setGender("female") : $user2->setGender("male") ;
        if($user2->getGender() != $user->getGender()){
        $_SESSION['gender']  = $_POST['gender'];
        if (UserDatabase::updateUserGender($user, $user2->getGender())) { 
            $_SESSION['formSuccessCode3'] = 'genderChanged';
        }else {
			$_SESSION['formErrorCode'] = 'databaseError';
		}}

        header('Location: ../UserEdit.php' ); 
    }
?>