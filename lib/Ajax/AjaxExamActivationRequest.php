<?php
	include_once("../Lib.php");
	header("content-type:application/json");
	
	function handlingError($msg) {
		echo json_encode(array("status" => "failed", "errorMsg" => $msg));
	}
	
	function handlingSuccess() {
		echo json_encode(array("status" => "success", "errorMsg" => ""));
	}
	
	$id = -1;
	$mode = "";
	$user = null;
	
	if (!isset($_SESSION["USER"])) {
		$errorMsg = "Błąd krytyczny: użytkownik jest niezalogowany.";
		handlingError($errorMsg);
		return;
	} else {
		$user = unserialize($_SESSION["USER"]);
	}
	
	if (!isset($_POST["id"]) || !isset($_POST["mode"])) {
		$errorMsg = "Nie przekazano parametrów do wywołania ajax.";
		handlingError($errorMsg);
		return;
	} else {
		$id = $_POST["id"];
		$mode = $_POST["mode"];
	}
	
	if ($mode == "activate") {
		
	} elseif ($mode == "deactivate") {
		
	} else {
		$errorMsg = "Parametr 'mode' ($mode) przyjmuje złą wartość.";
		handlingError($errorMsg);
		return;
	}
	
	handlingSuccess();
?>
