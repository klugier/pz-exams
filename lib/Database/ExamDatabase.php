<?php

include_once("User.php");
include_once("Exam.php");
include_once("DatabaseConnector.php");

final class ExamDatabase
{
	/*
	 * Sprawdza czy egzamin o danym ID istnieje w bazie danych.
	 */
	static public function checkExamID($id)
	{
		$sql = "Select * from Exams where ID = '" . $id . "'";
		
		DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
    
	/*
	 * Sprawdza czy egzamin o danej nazwie istnieje w bazie danych.
	 */
	static public function checkExamName($name)
	{
		$sql = "Select * from Exams where Name = '" . $name . "'";
		
		echo DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
	
	/*
	 * Zwraca listę egzaminów w tabeli danego usera
	 */
	static public function getExamList($userid)
	{
		$sql = "SELECT * FROM Exams WHERE UserID = '" . $userid . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		if (!$result) {
			return null;
		}
        
		$i = 0;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
            
			$resultExam[$i] = new Exam(); 
			$resultExam[$i]->setID($row['ID']);
			$resultExam[$i]->setUserID($row['UserID']);
			$resultExam[$i]->setName($row['Name']);
			$resultExam[$i]->setDuration($row['Duration']);
			$resultExam[$i]->setActivated($row['Activated']);
			$i++;
		
        }
        
		return $resultExam;
	}  
    
	/*
	 * Zwraca ilość egzaminów danego usera
	 */
	static public function getExamNum($userid)
	{
		$sql = "Select * from Exams WHERE UserID = '" . $userid . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$numRows = $result->num_rows;
        
		return $numRows;
	}
	
	/*
	 * Funkcja do aktywacji egzaminu 
	 */
	static public function activateExam($user, $exam)
	{
		$sql = "Select * from Exams WHERE ID  = '" . $exam->getID() . "' AND UserID = '" . $user->getID() . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		if ($result->num_rows == 0) { 
			return false;
		}
		
		$sql = "UPDATE Exams SET 
		        Activated = '" . $exam->getActivated() . "' 
		        WHERE ID = '" . $exam->getID() . "'";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
	
    
	/*
	 * Dodanie egzaminu do bazy danych 
	 */
	static public function insertExam($user, $exam)
	{ 
		$values = "('"	. $user->getID() . "','"
		                . $exam->getName() . "','" 
		                . $exam->getDuration() . "',"
						. $exam->getActivated() . "')";  
				
		$sql =  "INSERT INTO Exams (UserID, Name, Duration, Activated)" 
		        .  "VALUES $values";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
    
	/*
	 * Edycja egzaminu (nazwa, czas trwania) w bazie danych, wraz ze sprawdzeniem czy dany egzaminator
	 * zamieścił egzamin i ma do tego uprawnienia
	 */ 
	static public function updateExam($user, $exam)
	{
		$sql = "Select * from Exams WHERE ID  = '" . $exam->getID() . "' AND UserID = '" . $user->getID() . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		if ($result->num_rows == 0) { 
			return false;
		}
		
		$sql = "UPDATE Exams SET 
		        Name  = '" . $exam->getName() . "', 
		        Duration = '" . $exam->getDuration() . "' 
		        WHERE ID = '" . $exam->getID() . "'";
					
		DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
    
	/*
	 * Usunięcie egzaminu z bazy danych, wraz ze sprawdzeniem czy dany egzaminator
	 * zamieścił egzamin i ma do tego uprawnienia
	 */ 
	static public function deleteExam($user, $exam)
	{
		$sql = "Select * from Exams WHERE ID  = '" . $exam->getID() . "' AND UserID = '" . $user->getID() . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		if ($result->num_rows == 0) { 
			return false;
		}
		
		$sql = "Delete from Exams WHERE ID  = '" . $exam->getID() . "'";
		DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
    
	// Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
	private function __construct() { }
}

?>
