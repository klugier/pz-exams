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
		$sql = "Select * from Users where Email = '".$basicUser->getEmail()."'";
		echo $sql;
		
		$result = DatabaseConnector::getConnection()->query($sql);
		$row_num = $result ->num_rows;
		if($row_num == 1)
		{
			return true;
		} else {
			return false;
		}

	}
	
	/*
	 * Metoda sprawdza czy przypisane hasło do klasy $user jest poprawne.
	 */
	static public function checkPassword($basicUser)
	{
		$sql = "Select * from Users where Email = '". $basicUser->getEmail()."' && Password = '". $basicUser->getPassword()."'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$row_num = $result ->num_rows;
		if($row_num == 1)
		{
			$result = DatabaseConnector::getConnection()->query($sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$basicUser->setID($row['ID']);
			return true;
		}
		return false;		
	}
	
	static public function addUser($user)
	{ 
		$values = "('"	. $user->getEmail() . "','"
						. $user->getPassword() . "'," 
						. (is_null($user->getName()) ? "NULL" : "'" . $user->getName() . "'")  . "," 
						. (is_null($user->getSurname()) ? "NULL" : "'" . $user->getSurname() . "'") . ",'private','examiner' ," 
						. (is_null($user->getGender()) ? "NULL" : "'" .$user->getGender() . "'" ) . " , '"
						. date("Y/m/d") . "')";  
				
		$sql =  "INSERT INTO Users (Email, Password, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate)" 
			 .	"VALUES $values";

		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
	
	static public function  getId (  $id ) 
	{ 
		$sql =  "SELECT * FROM Users WHERE ID = " . $id ;
		$result = DatabaseConnector::getConnection() -> query($sql) ;
		// user does not exist 
		if ( $result->num_rows != 1 )
			return null ; 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		 
		$resultUser = new User ( ) ; 
		$resultUser->setID ($row['ID'])  ;
		$resultUser->setEmail ($row['Email'])  ;
		$resultUser->setPassword ($row['Password'])  ;
		$resultUser->setName ($row['FirstName'])  ;
		$resultUser->setSurname ($row['Surname'])  ;
		$resultUser->setGender ($row['Gender'])  ;
		
		return $resultUser ;
	} 
		
	// Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
	private function __construct() { }
}

?>
