<?php
 
include_once("Calendar.php");
include_once("DatabaseConnector.php");

final class CalendarDatabase
{
	/*
	 * Zwraca instancje Calendar dla egzaminu o zadanym ID
	 */
	static public function getCalendarForExamId($id)
	{
		$sql = "SELECT * FROM Exams  JOIN ExamUnits ON ExamUnits.ExamID = Exams.ID WHERE Exams.ID = '" . $id . "'";
		$result = DatabaseConnector::getConnection()->query($sql);
		$exam = new Exam () ;
		$examUnit = null ;         
		$row = $result->fetch_assoc ();
		$exam->setName ( $row['Name'] ) ;
	    $exam->setDuration ( $row['Duration'] );  
		$calendar = new BasicCalendar ( $exam )  ;
		// przesun wskaźnik na początek 
		$row = $result->data_seek(0);			
		
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$examUnit = new ExamUnit () ; 
			$examUnit->setDay($row['Day']);
			$examUnit->setTimeFrom($row['TimeFrom']);
			$examUnit->setTimeTo($row['TimeTo']);
			$calendar->addExamUnit($examUnit);
		}
		return $calendar;
	}  
 	
	private function __construct() { }
} 

// only test purpose 
echo "<h1> Calendar Database Test is done . </h1> " ; 
CalendarDatabase::getCalendarForExamId(12)->printCalendar(); 

?>
