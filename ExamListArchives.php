<?php
	ob_start();
	
	include_once("lib/Lib.php");
	
	$title = "$appName - Lista egzaminów";
	$scripts = array("js/Lib/bootbox.min.js", "js/ExamList.js");
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/UserPanel.php");
	
	$id = unserialize($_SESSION['USER'])->getID();
	$exams = ExamDatabase::getExamList($id);
	
	include("html/End.php");
	ob_end_flush();
?>
