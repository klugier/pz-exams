<?php
	include_once("Exam.php");
	include_once("ExamUnit.php");
	
	class BasicCalendar  
	{ 
		public function __construct($exam) {
			$this->exam = $exam;
			$this->examUnitsList = array(); 
		}

		public function addExamUnit($examUnit) { 
			array_push($this->examUnitsList, $examUnit);   
		}		
	
		public function getExam() {
			return $this->exam;
		}
		
		public function printCalendar() { 
			echo "Exam name : " . $this->exam->getName() . "<br />";
			echo "Exam duration : " . $this->exam->getDuration() . "<br />";
			foreach ($this->examUnitsList as $examUnit) {  
				echo "Day " . $examUnit->getDay() . " od " . $examUnit->getTimeFrom() . " - do " . $examUnit->getTimeTo() . "<br />"; 
			} 
		} 
	
		public function prepareJSONEncodeFormat() { 
			$jsonEncodeDataFormat = array('status' => 'dataRecived' , 'examID' => 'existsInDB' , "name"=> $this->exam->getName() , "examUnits"=>array( ));
			foreach ($this->examUnitsList as $examUnit) {
				array_push($jsonEncodeDataFormat['examUnits'] ,  array("day"=>$examUnit->getDay() , "timeFrom"=>$examUnit->getTimeFrom() , "timeTo"=>$examUnit->getTimeTo())) ;
			}
			return $jsonEncodeDataFormat ; 
		} 
		
		private $exam;
		private $examUnitsList;
	} 

?>
