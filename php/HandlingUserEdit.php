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
        if( $user->getPassword() !=  $_POST['passwd-old']){// Check if present passord is correct
            $_SESSION['formErrorCode'] = 'passwordIncorrect';
        }else{
            if (UserDatabase::updateUserPassword($user, $_POST['passwd'])) { 
                $_SESSION['formSuccessCode'] = 'passwordChanged';
            }else {
			    $_SESSION['formErrorCode'] = 'databaseError';
		    }
        }
        header('Location: ../UserEdit.php' ); 
    }

    if (isset($_POST['submitButtonName']) == true) {
	    $_SESSION['name']    = $_POST['name'];
        $user = unserialize($_SESSION['USER']);
        if (UserDatabase::updateUserFirstName($user, $_SESSION['name'])) { 
            $_SESSION['formSuccessCode'] = 'nameChanged';
        }else {
			$_SESSION['formErrorCode'] = 'databaseError';
		} 
        header('Location: ../UserEdit.php' ); 
    }

    if (isset($_POST['submitButtonSurname']) == true) {
	    $_SESSION['surname'] = $_POST['surname'];
        $user = unserialize($_SESSION['USER']);
        if (UserDatabase::updateUserSurname($user, $_SESSION['surname'])) { 
            $_SESSION['formSuccessCode'] = 'surnameChanged';
        }else {
			$_SESSION['formErrorCode'] = 'databaseError';
		}
        header('Location: ../UserEdit.php' ); 
    }

    if (isset($_POST['submitButtonGender']) == true) {
        $_SESSION['gender']  = $_POST['gender'];
        $user = UserDatabase::getUser(unserialize($_SESSION['USER'])->getID() );
        ( $_POST['gender'] == "Kobieta" ) ? $user->setGender("female") : $user->setGender("male") ;
        if (UserDatabase::updateUserGender($user, $user->getGender())) { 
            $_SESSION['formSuccessCode'] = 'genderChanged';
        }else {
			$_SESSION['formErrorCode'] = 'databaseError';
		}
        header('Location: ../UserEdit.php' ); 
    }
?>