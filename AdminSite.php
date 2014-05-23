<?php
	ob_start();
	include_once("lib/Lib.php");
	
	function finish() {
		include("html/End.php");
		ob_end_flush();
	}
	
	$title = "$appName - Strona admina";
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/AdminPanel.php");
	
	$user = unserialize($_SESSION['USER']);
	
	echo "<h2>Strona admina - ";
	if ($user->getFirstName() != NULL && $user->getSurname() != NULL)
		echo $user->getFirstName() . " " . $user->getSurname();
	else
		echo $user->getEmail();
	echo "</h2>";
	echo "<h3>Witaj! Miłego dnia.";
	echo "</h3>";
	finish();
?>
