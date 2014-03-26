<?php

include_once("User.php");
include_once("Exam.php");
include_once("DatabaseConnector.php");

final class UserDatabase
{
	/*
	 * Metoda sprawdza czy egz o zadanej nazwie istnieje w bazie danych.
	 */
	static public function checkExam($exam)
	{
		$sql = "Select * from Exams where Name = '$exam->getName()'";
		
		DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
	
    
    /*
     * Dodanie egzaminu do bazy danych 
     */
	static public function addExam($user, $exam)
	{ 
		$values = "('"	. $user->getID() . "','"
				        . $exam->getName() . "','" 
				        . $exam->getDuration() . "')";  
				
		$sql =  "INSERT INTO Users (UserID, Name, Duration)" 
			 .	"VALUES $values";

		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
    
    /*
     * Edycja egzaminu (nazwa, czas trwania) w bazie danych, wraz ze sprawdzeniem czy dany egzaminator
     * zamieścił egzamin i ma do tego uprawnienia
     */ 
    static public function editExam($user, $exam)
    {
        $sql = "Select * from Exams WHERE ID  = '$exam->getID()' AND UserID = '$user->getID()'";
        $result = mysql_query($sql);
		$numRows = mysql_num_rows($result);
		if ($numRows == 0) { 
            return false;
        }else{
            $sql = "UPDATE Exams SET Name  = '$exam->getName()', Duration = '$exam->getDuration()' WHERE ID = $exam->getID";
            DatabaseConnector::getConnection()->query($sql) ? true : false;
        }
    } 
    
    /*
     * Usunięcie egzaminu z bazy danych, wraz ze sprawdzeniem czy dany egzaminator
     * zamieścił egzamin i ma do tego uprawnienia
     */ 
    static public function delExam($user, $exam)
    {
        $sql = "Select * from Exams WHERE ID  = '$exam->getID()' AND UserID = '$user->getID()'";
        $result = mysql_query($sql);
		$numRows = mysql_num_rows($result);
		if ($numRows == 0) { 
            return false;
        }else{
            $sql = "Delete from Exams WHERE ID  = '$exam->getID()' AND UserID = '$user->getID()'";
            DatabaseConnector::getConnection()->query($sql) ? true : false;
        }
    }
    
	// Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
	private function __construct() { }
}

?>
