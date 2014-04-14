<?php

include_once("User.php");
include_once("Exam.php");
include_once("DatabaseConnector.php");

final class ExamDatabase
{
	/*
	 * Sprawdza czy egzamin o danym ID istnieje w bazie danych.
	 */
	static public function checkExamID($ID)
	{
		$sql = "Select * from Exams where ID = '" . $ID . "'";
		
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
	 * Zwraca exam o danym ID
	 */
	static public function getExam($id)
	{
		$sql = "SELECT * FROM Exams WHERE ID = '" . $id . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$exam = null;
        
		if($row = $result->fetch_array(MYSQLI_ASSOC)){
			$exam = new Exam(); 
			$exam->setID($row['ID']);
			$exam->setUserID($row['UserID']);
			$exam->setName($row['Name']);
			$exam->setDuration($row['Duration']);
			$exam->setActivated($row['Activated']);
			$exam->setEmailsPosted($row['EmailsPosted']);
		}
		return $exam;
	}  
	/*
	 * Zwraca listę egzaminów w tabeli danego usera
	 */
	static public function getExamList($userID)
	{
		$sql = "SELECT * FROM Exams WHERE UserID = '" . $userID . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$exams = null;
        
		$i = 0;
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$exams[$i] = new Exam(); 
			$exams[$i]->setID($row['ID']);
			$exams[$i]->setUserID($row['UserID']);
			$exams[$i]->setName($row['Name']);
			$exams[$i]->setDuration($row['Duration']);
			$exams[$i]->setActivated($row['Activated']);
			$exams[$i]->setEmailsPosted($row['EmailsPosted']);
			$i++;
        }
        
		return $exams;
	}  
    
	/*
	 * Zwraca ilość egzaminów danego usera
	 */
	static public function countExams($userID)
	{
		$sql = "SELECT COUNT(UserID) AS UserExams FROM Exams
		        WHERE UserID = '" . $userID . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$row = $result->fetch_array(MYSQLI_NUM);
		
		return $row[0];
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
		$row=$result->fetch_array(MYSQLI_ASSOC);
		$active = $row['Activated'];
		
		if($active){
			$active=false;
		}else{
			$active=true;
		}	
		
		$sql = "UPDATE Exams SET 
		        Activated = '" . $active . "' 
		        WHERE ID = '" . $exam->getID() . "'";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
	
	static public function PostEmail($user, $exam)
	{
		$sql = "Select * from Exams WHERE ID  = '" . $exam->getID() . "' AND UserID = '" . $user->getID() . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		if ($result->num_rows == 0) { 
			return false;
		}
		
		$sql = "UPDATE Exams SET 
		        EmailsPosted = '" . $exam->getEmailsPosted() . "' 
		        WHERE ID = '" . $exam->getID() . "'";
		
		return DatabaseConnector::getConnection()->query($sql) ? true : false;
	}
    
	/*********************************************************************
	 ********************* Podstawowe funkcje sql ************************
	 *********************************************************************/
		 
	static public function insertExam($user, $exam)
	{ 
		$values = "('"	. $user->getID() . "','"
		                . $exam->getName() . "','" 
		                . $exam->getDuration() . "','"
		                . $exam->getActivated() . "','"  
		                . $exam->getEmailsPosted() . "')";
				
		$sql =  "INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted)" 
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
