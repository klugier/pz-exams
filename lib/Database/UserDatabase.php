<?php

include_once("User.php");

class UserDatabase
{
	/*
	 * Metoda sprawdza czy użytkownik o zadanym e-mailu istnieje w bazie danych.
	 */
	static public function checkEmail($user)
	{
		$sql = "Select * from Users where Email = '$user->getEmail()'";
        	$result = mysql_query($sql);
        	$numRows = mysql_num_rows($result); // <- Styl kodowania Zend!!!
        	if ($numRows == 1) {
            		return true;
        	} else { // <- Zend
            		return false;
        	}
	}
	
	/*
	 * Metoda sprawdza czy przypisane hasło do klasy $user jest poprawne.
	 */
	static public function checkPassword($user)
	{
		$sql = "Select * from Users where Email = '$user->getEmail()' && Password = '$user->getPassword()'";
        	$res = mysql_query($sql);
        	$numRows = mysql_num_rows($result);
        	if ($num_rows == 1) {            
            		return true;
        	} else {
            		return false;
        	}   
	}
	
	// Nie pozwalamy na utworzenie obiektu, chemy utrzymać obiektowy styl aplikacji
	private function __construct() { }
}

?>
