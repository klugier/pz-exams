<?php

include_once("User.php");
include_once("DatabaseConnector.php");

final class UserDatabase
{
	/*
	 * Metoda sprawdza czy użytkownik o zadanym e-mailu istnieje w bazie danych.
	 */
	static public function checkEmail($basicUser)
	{
		$sql = "Select * from Users where Email = '$basicUser->getEmail()'";
		
		DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
	
	/*
	 * Metoda sprawdza czy przypisane hasło do klasy $user jest poprawne.
	 */
	static public function checkPassword($basicUser)
	{
		$sql = "Select * from Users where Email = '$basicUser->getEmail()' && Password = '$basicUser->getPassword()'";
		$result = mysql_query($sql);
		$numRows = mysql_num_rows($result);
		if ($numRows == 1) {
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$user->setId($row[0]);
			}     
			return true;
		} else {
			return false;
		}   
	}
	
	static public function addUser($user)
	{ 
		$values = "('"	. $user->getEmail() . "','"
				        . $user->getPassword() . "','" 
				        . $user->getName() . "','arek ','private','examiner' , 'female' , '"
				        . date("Y/m/d") . "')";  
				
		$sql =  "INSERT INTO Users (Email, Password, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate)" 
			 .	"VALUES $values";

		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
	
	// Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
	private function __construct() { }
}

?>
