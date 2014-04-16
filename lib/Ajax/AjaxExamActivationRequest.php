<?php
	include_once("../Lib.php");
	header("content-type:application/json");
	
	function handlingError($msg) {
		echo json_encode(array("status" => "failed", "errorMsg" => $msg));
	}
	
	function handlingSuccess() {
		echo json_encode(array("status" => "success", "errorMsg" => ""));
	}
	

	$user = null;
	
	if (!isset($_SESSION["USER"])) {
		$errorMsg = "Błąd krytyczny: użytkownik jest niezalogowany.";
		handlingError($errorMsg);
		return;
	} else {
		$user = unserialize($_SESSION["USER"]);
	}
	
	if (isset($_POST["examID"])) {
		$examID = $_POST["examID"];		
		$exam = ExamDatabase::getExam($examID);	
		ExamDatabase::activateExam($exam);	
	} else {
		$errorMsg = $_POST["examID"]."Nie przekazano parametrów do wywołania ajax.";
		handlingError($errorMsg);
		return;
	}
	
	handlingSuccess();
?>
