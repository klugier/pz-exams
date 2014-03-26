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
		$numRows = mysql_num_rows($result);
		if ($numRows == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	/*
	 * Metoda sprawdza czy przypisane hasło do klasy $user jest poprawne.
	 */
	static public function checkPassword($user)
	{
		$sql = "Select * from Users where Email = '$user->getEmail()' && Password = '$user->getPassword()'";
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
	
	public function addUser ( $user )
	{ 
		$values = "('"	. $user->getEmail() . "','"
				. $user->getPassword() . "','" 
				. $user->getName() . "','arek ','private','examiner' , 'female' , '"
				. date("Y/m/d") . "' )";  
				
		$sql =  "INSERT INTO Users  ( Email, Password, FirstName , Surname, Visibility , Rights , Gender , RegistretionDate)" 
			 .	"VALUES $values" ;

		if ($result = $this->activeConnection->getConnection()->query($sql)) {
			
			return true ; 
		} else { 
			return false ; 
		} 
	} 
	
	// Nie pozwalamy na utworzenie obiektu, chemy utrzymać obiektowy styl aplikacji
	function __construct(  ) 
	{ 
		$this->activeConnection = new DatabaseConnector('localhost','root','haslo','bazaZbigniew');
		$this->activeConnection -> connect();
	}
	
	private $activeConnection ;
}

?>
