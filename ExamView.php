<?php
	include_once("lib/Lib.php");

	$title = "$appName - Widok egzaminu";
	include("html/Begin.php");

	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}

	$userExamList = ExamDatabase::getExamList(unserialize($_SESSION['USER'])->getID());
	$accessEditExamGranted = false ; 
	foreach ($userExamList as $exam) { 
		if ( $exam->getID() == $_GET['id'] ) $accessEditExamGranted = true; 
	} 
	if ( ! $accessEditExamGranted ) header('Location: ExamList.php') ;	
	
	
	include("html/UserPanel.php");

	$id   = $_GET['id'];
	$exam = ExamDatabase::getExam($id);
	echo "<h2>Informacje o egzaminie</h2>";
	echo "<h4><i>(" . $exam->getName() . ")</i></h4>";
?>

<?php
	include("html/End.php");
?>

