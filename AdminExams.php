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

	$examList = ExamDatabase::getAllExams();

	if (!is_array($examList)) {
		$displayTable = ' style="display: none;"';
	} else {
		$displayInfo = ' display: none;"';
	}

	//echo '<pre>'; print_r($examList); echo '</pre>';

	echo '<div style="margin-top: 5%;"><h3 id="empty_list" style="text-align: center; margin-bottom: 4%;' . $displayInfo . '>Lista studentów jest obecnie pusta</h3>
		<table class="table" id="students"' . $displayTable . '>
		<thead>
			<tr>
				<th style="text-align: center;">Lp.</th>
				<th>Nazwa</th>
				<th>Czas</th>
				<th>Egzaminator</th>
				<th style="text-align: center;">Aktywny</th>
				<th style="text-align: center;">Przedawniony</th>
			</tr>
		</thead>
		<tbody>';

	if (is_array($examList)) {
		foreach ($examList as $number => $exam) {
			echo '<tr id="' . $exam->getID() . '">';
			echo '<td id="number" style="text-align: center;">' . ($number+1) .  '.</td>';
			echo '<td id="name">' . $exam->getName() . '</td>';
			echo '<td id="time"></td>';
			echo '<td id="examinator">' . $exam->getUserID() . '</td>';
			echo '<td style="text-align: center;" id="active">';
			if($exam->getActivated() == TRUE){
				echo "TAK";
			}else{
				echo "NIE";
			} 
			echo '</td>';
			echo '<td></td>';
			echo '</tr>';
		}
	}

	echo '</tbody></table></div>';

	include("html/End.php");
	
	ob_end_flush();
?> 