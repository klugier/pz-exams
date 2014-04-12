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
	
	
		static public function insertStudent($student)
		{
			$values = "('"	. $student->getEmail() . "','"
			                . strval(md5(microtime())) . "','"
			                . $student->getFirstName() . "','"
			                . $student->getSurName() . "')";
			
			$sql =  "INSERT INTO Students (Email, Code, FirstName, Surname) VALUES $values";
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
