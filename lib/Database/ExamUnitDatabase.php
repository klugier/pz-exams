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
	 * Zwraca listę ID examUnitsów dla danego egzaminu
	 */
	static public function getExamUnitIDList($exam)
	{ 
		$sql = "Select * from ExamUnits WHERE ExamID  = '" . $exam->getID() . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		
		$i = 0;
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
			$examUnitID[$i] = $row[0]; 
			$i++;
		}
		return $examUnitID;
	}

	static public function getExamUnitIDListDay($examID,$day)
	{ 
		$sql = "Select * from ExamUnits WHERE ExamID = '" . $examID . "' AND Day = '" . $day . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		
		$i = 0;
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
			$examUnitID[$i] = $row[0]; 
			$i++;
		}
		return $examUnitID;
	}
	
	static public function getExamUnit($id){
		$sql = "SELECT * FROM ExamUnits WHERE ID = '" . $id . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$examUnit = null;
        
		if($row = $result->fetch_array(MYSQLI_ASSOC)){
			$examUnit = new ExamUnit(); 
			$examUnit->setID($row['ID']);
			$examUnit->setExamID($row['ExamID']);
			$examUnit->setDay($row['Day']);
			$examUnit->setTimeFrom($row['TimeFrom']);
			$examUnit->setTimeTo($row['TimeTo']);
			$examUnit->setState($row['State']);
		}
		return $examUnit;
	}
	
	static public function countExamUnits($examID)
	{
		$sql = "SELECT COUNT(ExamID) AS UnitExamsCount FROM ExamUnits
		        WHERE ExamID = '" . $examID . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$row = $result->fetch_array(MYSQLI_NUM);
		
		return $row[0];
	}
	
	static public function countLockedExamUnits($examID)
	{
		$sql = "SELECT COUNT(ExamID) AS UnitExamsCount FROM ExamUnits
		        WHERE ExamID = '" . $examID . "' AND State = 'Locked'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$row = $result->fetch_array(MYSQLI_NUM);
		
		return $row[0];
	}
	
	static public function countLockedExamUnitsByDay($examID, $day)
	{
		$sql = "SELECT COUNT(ExamID) AS UnitExamsCount FROM ExamUnits
		        WHERE ExamID = '" . $examID . "' AND Day = '" . $day . "' AND State = 'Locked'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$row = $result->fetch_array(MYSQLI_NUM);
		
		return $row[0];
	}

	static public function getExamDays($examID){
		$sql = "SELECT DISTINCT Day FROM ExamUnits WHERE ExamID = '" . $examID . "' ORDER BY day ASC";
		$result = DatabaseConnector::getConnection()->query($sql);
		$days=null;
		
		$i=0;
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$days[$i]=$row[0];
			$i++;
		}
		
		return $days;
	}
	
	static public function getExamsOrderByDate(){
		$sql = "SELECT DISTINCT ExamID FROM ExamUnits ORDER BY day ASC";
		$result = DatabaseConnector::getConnection()->query($sql);
		$exams = null;
		
		$i=0;
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$exams[$i]=$row[0];
			$i++;
		}
		
		return $exams;
	}
	/*********************************************************************
	 ********************* Podstawowe funkcje sql ************************
	 *********************************************************************/
	 
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
	static public function deleteExamUnit($examUnitID)
	{
		$sql = "Delete from ExamUnits WHERE ID  = '" . $examUnitID . "'";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
    
	static public function deleteExamUnit2($examID,$day,$timeFrom)
	{
		$sql = "Delete from ExamUnits WHERE ExamID  = '" . $examUnitID . "' AND 
		                                    Day = '" . $day . "' AND 
		                                    TimeFrom = '" . $timeFrom . "'";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
	
	// Nie pozwalamy na utworzenie obiektu - Jeżeli zrozumiałeś design to nigdy nie zmienisz tego konstruktora na publiczny ;)
	private function __construct() { }
}

?>
