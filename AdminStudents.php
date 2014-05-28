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
	
	include("html/AdminPanel.php");

	$studentList = StudentDatabase::getAllStudents();

	if (!is_array($studentList)) {
		$displayTable = ' style="display: none;"';
	} else {
		$displayInfo = ' display: none;"';
	}

	echo '<div style="margin-top: 5%;"><h3 id="empty_list" style="text-align: center; margin-bottom: 4%;' . $displayInfo . '>Lista studentów jest obecnie pusta</h3>
		<table class="table" id="students"' . $displayTable . '>
		<thead>
			<tr>
				<th style="text-align: center;">Lp.</th>
				<th style="text-align: center;">ID</th>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>E-mail</th>
				<th style="text-align: center;">Ma aktywne egzaminy</th>
				<th style="text-align: center;">Usuń</th>
			</tr>
		</thead>
		<tbody>';

	if (is_array($studentList)) {
		foreach ($studentList as $number => $student) {
			echo '<tr id="' . $student->getID() . '">';
			echo '<td id="number" style="text-align: center;">' . ($number+1) .  '.</td>';
			echo '<td id="studentID" style="text-align: center;">' . $student->getID() . '</td>';

			$fName = "-";
			$lName = "-";

			if ($user->getFirstName() != "") {
				$fName = $student->getFirstName();
			}

			if ($user->getSurname() != "") {
				$lName = $student->getSurname();
			}

			echo '<td id="firstname">' . $fName . '</td>';
			echo '<td id="lastname">' . $lName . '</td>';
			echo '<td id="emails">' . $student->getEmail() . '</td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '</tr>';
		}
	}

	echo '</tbody></table></div>';

	include("html/End.php");
	
	ob_end_flush();
?> 