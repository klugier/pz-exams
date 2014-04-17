<?php
	
	include_once("Student.php");
	include_once("DatabaseConnector.php");
	
 	final class StudentDatabase
 	{
	
		// Do testów
		static public function getStudentID($student)
		{ 
			$sql = "Select * from Students WHERE Email  = '" . $student->getEmail() . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
		
			$row = $result->fetch_array(MYSQLI_NUM);
			return $row[0];
		}
		
		static public function getStudentByCode($code)
		{ 
			$sql = "Select * from Students WHERE Code  = '" . $code . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			$student = new Student();
			$student->setID($row['ID']);
			$student->setEmail($row['Email']);
			$student->setCode($row['Code']);
			$student->setFirstName($row['FirstName']);
			$student->setSurName($row['Surname']);
			
			return $student;		
		}
	
		static public function getStudentByID($id)
		{ 
			$sql = "Select * from Students WHERE ID  = '" . $id . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			$student = new Student();
			$student->setID($row['ID']);
			$student->setEmail($row['Email']);
			$student->setCode($row['Code']);
			$student->setFirstName($row['FirstName']);
			$student->setSurName($row['Surname']);
			
			return $student;
		}
	
		static public function insertStudent($student)
		{
			$values = "('"	. $student->getEmail() . "','"
			                . $student->getFirstName() . "','"
			                . $student->getSurName() . "')";
			
			$sql =  "INSERT INTO Students (Email, FirstName, Surname) VALUES $values";
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 
		
		static public function addStudentCode($studentID, $code)
		{
			$sql = "Select * from Students WHERE ID  = '" . $studentID . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}
			$row=$result->fetch_array(MYSQLI_ASSOC);
			
			if(!$row['Code']==NULL){
				return false;
			}
		
			$sql = "UPDATE Students SET 
			        Code  = '" . $code . "'
			        WHERE ID = '" . $student->getID() . "'";
			
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		}
		
		static public function updateStudent($student)
		{
			$sql = "Select * from Students WHERE ID  = '" . $student->getID() . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}
		
			$sql = "UPDATE Students SET 
			        Email  = '" . $student->getEmail() . "', 
			        FirstName = '" . $student->getFirstName() . "', 
			        Surname = '" . $student->getSurName() . "'
			        WHERE ID = '" . $student->getID() . "'";
			
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 
    
		/*
		 * Usunięcie egzaminu z bazy danych, wraz ze sprawdzeniem czy dany egzaminator
		 * zamieścił egzamin i ma do tego uprawnienia
		 */ 
		static public function deleteStudent($student)
		{
			$sql = "Select * from Students WHERE ID  = '" . $student->getID() . "'";
			$result = DatabaseConnector::getConnection()->query($sql);
			if ($result->num_rows == 0) { 
				return false;
			}
		
			$sql = "Delete from Students WHERE ID  = '" . $student->getID() . "'";
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		}
		
		private function __construct() { }
	}
?>