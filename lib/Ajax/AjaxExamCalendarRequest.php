<?php
	include_once("../../lib/Lib.php");
	include_once("../../lib/Database/CalendarDatabase.php");
	include_once("../../lib/Database/Calendar.php");
	header("content-type:application/json");
	
	// test 
	$_POST['examID'] = 12 ;
	$examIDNotInDBJSON = array ('status' => 'dataRecived' , 'examID' => 'notInDB') ;
	
	if (isset($_POST['examID'])) {
		$calendar = null;  
		if ($calendar = CalendarDatabase::getCalendarForExamId($_POST['examID'])) {
			echo json_encode($calendar->prepareJSONEncodeFormat()); 
		} else { 
			echo json_encode($examIDNotInDBJSON) ; 
		} 
	} else { 
		echo json_encode($examIDNotInDBJSON) ; 
	}
		
?>