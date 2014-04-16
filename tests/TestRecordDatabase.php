<?php
	include("TestBegin.php");
	
	include_once('../lib/Lib.php');
	
	$testRecords[0] = new Record;	
	$testRecords[0]->setStudentID(21);
	$testRecords[0]->setExamID(16);
	$testRecords[0]->setExamUnitID(1);
	
	
	
	echo RecordDatabase::countAssignedExamUnits(15) . "<br/>";
	
	
	
	
	
	
	
	/*if(RecordDatabase::insertRecord($testRecords[0])){
		echo "Done and Done <br/>";
	}else{
		echo "nope <br/>";
	}
	
	$testRecords[0]->setID(RecordDatabase::getRecordID(16, 21));	
	$testRecords[0]->setExamID(15);
	
	if(RecordDatabase::updateRecord($testRecords[0])){
		echo "Updated<br/>";
	}else{
		echo "Something went Wrong<br/>";
	}
		
	if(RecordDatabase::deleteRecord($testRecords[0])){
		echo "There's no more evidence of ". $testRecords[0]->getID() . "<br/>";
	}else{
		echo "nope<br/>";
	}*/

	
	include("TestEnd.php");
?>
