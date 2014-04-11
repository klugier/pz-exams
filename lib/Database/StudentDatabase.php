<?php
	include_once("Student.php");
	include_once("DatabaseConnector.php");
    
	final class StudentDatabase
	{
		static public function insertStudent($student)
		{
			$values = "('"	. $student->getEmail() . "','"
							. $student->getFirstName() . "','"
							. $student->getSurName() . "')";
			
			$sql =  "INSERT INTO Students (Email, FirstName, Surname) VALUES $values";
			
			return DatabaseConnector::getConnection()->query($sql) ? true : false;
		} 
		
		private function __construct() { }
	}
?>
