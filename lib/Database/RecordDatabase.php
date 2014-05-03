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

		static public function getRecordFromUnit($examUnitID)
		{
			$sql = "Select * from Records WHERE ExamUnitID  = '" . $examUnitID . "'";
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
		 * Zwraca listę ID Studentów przypisanych do egzaminów
		 */
		static public function getStudentIDList($examID){
			$sql = "Select * from Records WHERE ExamID  = '" . $examID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$studentID = null;
			
			$i = 0;
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$studentID[$i] = $row['StudentID']; 
				$i++;
			}
			return $studentID;
		}
		
		/* 
		 * Zwraca ID ExamUnitsów i Studentów jezeli jest przypisany, lub NULL jeżeli nie jest przypisany
		 */
		static public function getExamUnitIDStudentIDList($examID){
			$sql = "Select * from Records WHERE ExamID = '" . $examID . "' AND StudentID  != 'NULL'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$records = null;
			
			$i = 0;
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$records[$i]['ExamUnitID'] = $row['ExamUnitID']; 
				$records[$i]['StudentID'] = $row['StudentID'];
				$i++;	
			}

			return $records;
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
		
		/*
		 * Zwraca liczbe Studentów Egzaminatora
		 */
		static public function countStudentsByExam($examID){
			$sql = "SELECT count(StudentID) FROM Records 
			        WHERE ExamID = '" . $examID . "'";
					
			$result = DatabaseConnector::getConnection()->query($sql);
			$studentCount=0;
			
			if($result!=null){
				$row = $result->fetch_array(MYSQLI_NUM);
				$studentCount=$row[0];
			}	
			
			return $studentCount;
		}
		
		/*
		 * Zwraca liczbe Studentów Egzaminatora
		 */
		static public function countUserStudents($userID){
			$sql = "SELECT count(Exams.ID) FROM Records INNER JOIN Exams ON Records.ExamID = Exams.ID 
			        WHERE Exams.UserID = '" . $userID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$examCount=0;
			
			if($result!=null){
				$row = $result->fetch_array(MYSQLI_NUM);
				$examCount=$row[0];
			}
			
			
			return $examCount;
		}
		
		/*
		 * Zwraca liczbe Studentów Egzaminatora zapisanych na egzaminy
		 */
		static public function countUserStudentsSingedToExams($userID){
			$sql = "SELECT count(Exams.ID) FROM Records INNER JOIN Exams ON Records.ExamID = Exams.ID 
			        WHERE Exams.UserID = '" . $userID . "' AND Records.ExamUnitID != 'NULL'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$examCount=0;
			
			if($result!=null){
				$row = $result->fetch_array(MYSQLI_NUM);
				$examCount=$row[0];
			}
			
			
			return $examCount;
		}
		
		static public function recordTransaction($recordID,$examUnitID)
		{
			$transaction = DatabaseConnector::getConnection();
			
			try{			
				$transaction->begin_transaction();
				$sql = "Select * from Records WHERE ID  = '" . $recordID . "'";
				$result = $transaction->query($sql);
				if ($result->num_rows == 0) { 
					throw new Exception('There is no such Record');
				}
				
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if($row['ExamUnitID']!=0){
					throw new Exception('Overwriting not allowed');
				}
				
				$sql = "UPDATE Records SET 
						ExamUnitID = '" . $examUnitID . "'
						WHERE ID = '" . $recordID . "'";
					
				if($transaction->query($sql)? false:true){
					throw new Exception('Something failed while update');
				}
				
				$sql = "Select * from Records WHERE ID  = '" . $recordID . "'";
				$result = $transaction->query($sql);				
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if($row['ExamUnitID']!=$examUnitID){
					throw new Exception('Overwriting not allowed');
				}
			
				$transaction->commit();
				
			}catch(Exception $e){
				$transaction->rollback();
				return false;
			}
			
			return true;
		} 
		
		/*********************************************************************
		 ********************* Podstawowe funkcje sql ************************
		 *********************************************************************/
		 
		static public function insertRecord($recordU)
		{
			$recordStudentID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getStudentID());
			$recordExamID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getExamID());
			
			$values = "('"	. $recordStudentID . "','"
			                . $recordExamID .  "')";
			
			$sql =  "INSERT INTO Records (StudentID, ExamID) VALUES $values";
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 
		
		static public function updateRecord($recordU)
		{
			$recordID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getID());
			$recordStudentID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getStudentID());
			$recordExamID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getExamID());
			$recordExamUnitID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getExamUnitID());
			
			$sql = "Select * from Records WHERE ID  = '" . $recordID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}

			$sql = "UPDATE Records SET 
			        StudentID  = '" . $recordStudentID . "', 
			        ExamID = '" . $recordExamID . "', 
			        ExamUnitID = '" . $recordExamUnitID . "'
			        WHERE ID = '" . $recordID . "'";
				
			
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 

		static public function deleteRecord($recordU)
		{
			$recordID = mysqli_real_escape_string(DatabaseConnector::getConnection(), $recordU->getID());
			
			$sql = "Select * from Records WHERE ID  = '" . $recordID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}
			
			$sql = "Delete from Records WHERE ID  = '" . $recordID . "'";
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		}
		
		private function __construct() { }
	}
?>