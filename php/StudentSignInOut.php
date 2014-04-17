<?php
	
	include_once("../lib/Lib.php");
	
	if (isset($_POST['signOut']) == true) {
		// TEST CODE
		//echo "StudentID ".$_POST['innerStudentID'];
		//echo " ExamID ".$_POST['innerExamID'];
		//echo " StudentCode ".$_POST['innerStudentCode'];
		$examUnitID = RecordDatabase::getExamUnitID($_POST['innerExamID'],$_POST['innerStudentID']);
		$id = RecordDatabase::getRecordID($_POST['innerExamID'],$_POST['innerStudentID']);
		//echo "| Id got =". $examUnitID;
		$examunit = ExamUnitDatabase::getExamUnit($examUnitID);
		//echo "| Unit got";
		$record = RecordDatabase::getRecord($id);
		//echo "| Record got ". $record->getID();
		$record->setExamUnitID(0);
		//echo "| Record set";
		$examunit->setState('unlocked');
		//echo "| State set";
		if(RecordDatabase::updateRecord($record)){
		//	echo " updateRecord Succes";
			if(ExamUnitDatabase::updateExamUnit($examunit)){
		//		echo " updateExamUnit Succes";
			}else{
		//		echo " updateExamUnit Fail";
			}
		}else{
			echo " updateRecord Fail";
		}

		header('Location: ../../StudentExams.php?id='.$_POST['innerStudentCode']); 
	}
	
	if (isset($_POST['date']) == true) {
		echo "StudentID".$_POST['innerIStudentID'];//setInnerExamID($examID, $id);
		echo " ExamID".$_POST['innerIExamID'];
		echo " StudentCode".$_POST['innerIStudentCode'];
		echo " SessionExamID".$_SESSION['innerIExamID'];

		//header('Location: ../../StudentExams.php?id='.$_POST['innerIStudentCode']); 
	}
?>