<?php

include_once("Exam.php");
include_once("ExamUnit.php");
include_once("DatabaseConnector.php");

final class ExamUnitDatabase
{    
	// Do testów
	static public function getExamUnitID($exam)
	{ 
		$sql = "Select * from ExamUnits WHERE ExamID  = '" . $exam->getID() . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		
		$row = $result->fetch_array(MYSQLI_NUM);
		return $row[0];
	}

	/*
	 * Dodanie egzaminu do bazy danych 
	 */
	static public function insertExamUnit($exam, $examUnit)
	{ 
		$values = "('"	. $exam->getID() . "','"
		                . $examUnit->getDay() . "','" 
		                . $examUnit->getTimeFrom() . "','"
						. $examUnit->getTimeTo() . "','"
						. $examUnit->getState() . "')";  
				
		$sql =  "INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) 
		         VALUES $values";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
    
	/*
	 * Edycja egzaminu (nazwa, czas trwania) w bazie danych, wraz ze sprawdzeniem czy dany egzaminator
	 * zamieścił egzamin i ma do tego uprawnienia
	 */ 
	static public function updateExamUnit($examUnit)
	{
		$sql = "UPDATE ExamUnits SET 
		        Day  = '" . $examUnit->getDay() . "', 
		        TimeFrom = '" . $examUnit->getTimeFrom() . "',
				TimeTo = '" . $examUnit->getTimeTo() . "',
				State = '" . $examUnit->getState() . "'
		        WHERE ID = '" . $examUnit->getID() . "'";
					
		//echo $sql . "<br/>";
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	} 
    
	/*
	 * Usunięcie egzaminu z bazy danych, wraz ze sprawdzeniem czy dany egzaminator
	 * zamieścił egzamin i ma do tego uprawnienia
	 */ 
	static public function deleteExamUnit($examUnit)
	{
		$sql = "Delete from ExamUnits WHERE ID  = '" . $examUnit->getID() . "'";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
    
	// Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
	private function __construct() { }
}

?>
