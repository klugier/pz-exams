<?php
	
	include_once("Record.php");
	include_once("DatabaseConnector.php");
	
 	final class RecordDatabase
 	{
	
		// Do testów
		static public function getRecordID($record)
		{ 
			$sql = "Select * from Records WHERE StudentID  = '" . $record->getStudentID() . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
		
			$row = $result->fetch_array(MYSQLI_NUM);
			return $row[0];
		}
		
		/*
		 * Zwraca listę ID Examinow przypisanych do studenta
		 */
		static public function getExamIDList($studentID){
			$sql = "Select * from Exams WHERE StudentID  = '" . $studentID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$examID = null;
			
			$i = 0;
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$examID[$i] = $row[0]; 
				$i++;
			}
			return $examID;
		}
		
		/* 
		 * Zwraca ID ExamUnitsa jezeli jest przypisany, lub NULL jeżeli nie jest przypisany
		 */
		static public function getExamUnitID($examID,$studentID){
			$sql = "Select * from ExamUnits WHERE ExamID = '" . $examID . "' AND StudentID  = '" . $studentID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$examUnitID = null;
			
			if($row = $result->fetch_array(MYSQLI_ASSOC))
				$examUnitID = $row['ExamUnitID']; 

			return $examUnitID;
		}
	
		/*********************************************************************
		 ********************* Podstawowe funkcje sql ************************
		 *********************************************************************/
		 
		static public function insertRecord($record)
		{
			$values = "('"	. $record->getStudentID() . "','"
			                . $record->getExamID() . "','"
			                . $record->getExamUnitID() . "')";
			
			$sql =  "INSERT INTO Records (StudentID, ExamID, ExamUnitID) VALUES $values";
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 
		
		static public function updateRecord($record)
		{
			$sql = "Select * from Records WHERE ID  = '" . $record->getID() . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}
		
			$sql = "UPDATE Records SET 
			        StudentID  = '" . $record->getStudentID() . "', 
			        ExamID = '" . $record->getExamID() . "', 
			        ExamUnitID = '" . $record->getExamUnitID() . "'
			        WHERE ID = '" . $record->getID() . "'";
			
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 

		static public function deleteRecord($record)
		{
			$sql = "Select * from Records WHERE ID  = '" . $record->getID() . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}
		
			$sql = "Delete from Records WHERE ID  = '" . $record->getID() . "'";
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		}
		
		private function __construct() { }
	}
?>