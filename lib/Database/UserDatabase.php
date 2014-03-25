<?php

include_once("User.php");

class UserDatabase
{
	/*
	 * Metoda sprawdza czy użytkownik o zadanym e-mailu istnieje w bazie danych.
	 */
	static public function checkEmail($user)
	{
		// return false;
	}
	
	/*
	 * Metoda sprawdza czy przypisane hasło do klasy $user jest poprawne.
	 */
	static public function checkPassword($user)
	{
		// return false;
	}
	
	// Nie pozwalamy na utworzenie obiektu, chemy utrzymać obiektowy styl aplikacji
	private function __construct() { }
}

?>
