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
        if( $user->getPassword() !=  $_POST['passwd-old']){// Check if present passord is correct
            $_SESSION['formErrorCode'] = 'passwordIncorrect';
        }else{
            if (UserDatabase::updateUserPassword($user, $_POST['passwd'])) { 
                $_SESSION['formSuccessCode'] = 'passwordChanged';
                $user->setPassword($_POST['passwd']);
            }else {
			    $_SESSION['formErrorCode'] = 'databaseError';
		    }
        }
        header('Location: ../UserEdit.php' ); 
    }
    if (isset($_POST['submitButtonName']) == true) {
	    $_SESSION['name']    = $_POST['name'];
        $user = UserDatabase::getUser(unserialize($_SESSION['USER'])->getID() );
        //TODO Brakuje kodu do zmiany Usera w  Bazie Danych.

        $_SESSION['formSuccessCode'] = 'nameChanged';
        header('Location: ../UserEdit.php' ); 
    }
    if (isset($_POST['submitButtonSurname']) == true) {
	    $_SESSION['surname'] = $_POST['surname'];
        $user = UserDatabase::getUser(unserialize($_SESSION['USER'])->getID() );
    
        //TODO Brakuje kodu do zmiany Usera w  Bazie Danych.
    
        $_SESSION['formSuccessCode'] = 'surnameChanged';
        header('Location: ../UserEdit.php' ); 
    }
    if (isset($_POST['submitButtonGender']) == true) {
        $_SESSION['gender']  = $_POST['gender'];
        $user = UserDatabase::getUser(unserialize($_SESSION['USER'])->getID() );
        ( $_POST['gender'] == "Kobieta" ) ? $user->setGender("female") : $user->setGender("male") ;
    
        //TODO Brakuje kodu do zmiany Usera w  Bazie Danych.
    
        $_SESSION['formSuccessCode'] = 'genderChanged';
        header('Location: ../UserEdit.php' ); 
    }
?>