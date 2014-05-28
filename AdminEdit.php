<?php

	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - List studentów";
	$scripts = array("js/Lib/bootbox.min.js", "js/Lib/spin.min.js", "js/Lib/ladda.min.js");
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
	
		ob_end_flush();
		return;
	}

	$user = unserialize($_SESSION['USER']);
	
	if (!$user->getRight()=="administrator") {
		echo "<div class=\"alert alert-danger\"><b>Brak uprawnień</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/AdminPanel.php");

	$xml=simplexml_load_file("cfg/Settings.xml");

	echo "<h2>Edycja ustawień portalu</h2>";
	echo "<p>W tym miejscu można edytować ustawienia portalu.</p>";
	echo "<hr>";

	echo '<h4>Debug Mode</h4>';
	echo 'Włączony?: <input type="checkbox" '.($xml->Debug == 1 ? "checked=checked" : "").'>';
	echo '<hr>';

	echo '<h4>Dostępne Domeny</h4><br>';
	foreach( $xml->Domains->children() as $child) {
		echo $child->getName() . ": " . $child . "<br>";
	}
	echo '<hr>';

	echo '<h4>Ustawienia E-mail</h4><br>';
	foreach( $xml->Email->children() as $child) {
		echo $child->getName() . ": " . $child . "<br>";
	}
	echo '<hr>';

	echo '<h4>Ustawienia Autoryzacji</h4><br>';
	foreach( $xml->Authorization->children() as $child) {
		echo $child->getName() . ": " . $child . "<br>";
	}

	//echo '<pre>';
	//print_r($xml);
	//echo '</pre>';

	include("html/End.php");
	
	ob_end_flush();
?>