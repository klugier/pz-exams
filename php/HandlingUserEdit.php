<?php

include_once("../lib/Lib.php");

if (isset($_POST['submitButton']) == false) {
	//echo "przekierowanie poszło" ;
	header('Location: ../UserEdit.php' ); 
}

if (isset($_POST['submitButtonGender']) == true) {
	//echo "przekierowanie poszło" ; 
	$_SESSION['email'] = ""    ;
	$_SESSION['gender'] = ""  ;
	$_SESSION['name'] = ""   ;
	$_SESSION['surname'] = "" ;
	header('Location: ../UserEdit.php' ); 
}

?>