<?php
	
	include_once("Record.php");
	include_once("DatabaseConnector.php");
	
 	final class RecordDatabase
 	{
	
		/* 
		 * Zwraca ID Recordu jezeli jest przypisany, lub NULL jeżeli nie jest przypisany
		 */
		static public function getRecordID($examID, $studentID)
		{ 
			$sql = "Select * from Records WHERE ExamID = '" . $examID . "' AND StudentID  = '" . $studentID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$ID = null;
	
			if($row = $result->fetch_array(MYSQLI_NUM))
				$ID = $row[0]; 
	
			return $ID;
		}
		
		static public function getRecord($recordID)
		{
			$sql = "Select * from Records WHERE ID  = '" . $recordID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$record = null;
        
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				$record = new Record(); 
				$record->setID($row['ID']);
				$record->setStudentID($row['StudentID']);
				$record->setExamID($row['ExamID']);
				$record->setExamUnitID($row['ExamUnitID']);
			}
			
			return $record;
		}

		/*
		 * Zwraca listę ID Examinow przypisanych do studenta
		 */
		static public function getExamIDList($studentID){
			$sql = "Select * from Records WHERE StudentID  = '" . $studentID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$examID = null;
			
			$i = 0;
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$examID[$i] = $row['ExamID']; 
				$i++;
			}
			return $examID;
		}
		
		/* 
		 * Zwraca ID ExamUnitsa jezeli jest przypisany, lub NULL jeżeli nie jest przypisany
		 */
		static public function getExamUnitID($examID,$studentID){
			$sql = "Select * from Records WHERE ExamID = '" . $examID . "' AND StudentID  = '" . $studentID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$examUnitID = null;
			
			if($row = $result->fetch_array(MYSQLI_ASSOC))
				$examUnitID = $row['ExamUnitID']; 

			return $examUnitID;
		}
		
		static public function countAssignedExamUnits($examID)
		{
			$sql = "SELECT COUNT(ExamID) AS UnitExamsCount FROM Records
			        WHERE ExamID = '" . $examID . "' AND ExamUnitID != 'NULL'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$row = $result->fetch_array(MYSQLI_NUM);
			
			return $row[0];
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