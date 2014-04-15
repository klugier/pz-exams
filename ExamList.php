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
	
	if ($exams == null) {
		echo "<div class=\"alert alert-info\">";
		echo "<b>Nie dodałeś jeszcze żadnych egzaminów!</b> Zobacz jakie to proste i <u><b><a href=\"AddExam.php\">utwórz</a></b></u> swój pierwszy egzamin.";
		echo "</div>";
		
	} else {
		echo "<h2>Lista aktualnych egzaminów</h2>";
		echo "<hr />";
		
		echo '
		<table class="table">
			<thead>
				<tr>
					<th style="text-align: center">ID</th>
					<th>Nazwa</th>
					<th style="text-align: center">Zapełnienie</th>
					<th style="text-align: center">Aktywny</th>
					<th style="text-align: center">Operacje</th>
					<th style="text-align: center">Aktywacja</th>
				</tr>
			</thead>
			<tbody>
		';
		
		echo "<tr>\n";
		$i = 1;
		foreach ($exams as $exam) {
			echo "<tr id=\"row-id-" . $exam->getID() . "\">";
			echo "<td style=\"text-align: center;\">" . $exam->getID() . ".</td>\n";
			echo "<td id=\"row-name-id-" . $exam->getID() . "\">" . $exam->getName() . "</td>\n";
			
			echo "<td style=\"text-align: center\">0/0</td>";
			
			// Activated
			echo "<td id=\"row-activated-id-" . $i . "\" style=\"text-align: center;\">";
			if ($exam->getActivated()) {
				echo "<b style=\"color: #156815;\">Tak</b>";
			} else {
				echo "<b style=\"color: #801313;\">Nie</b>";
			}
			echo "</td>";
			
			// Options
			echo "<td style=\"text-align: center;\">" .
				 "<a href=\"\"><i class=\"glyphicon glyphicon-pencil\" style=\"margin-right: 10px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edytuj egzamin\"></i></a>" .
				 "<a id=\"row-delete-id-" . $exam->getID() . "\" style=\"cursor: pointer;\"><i class=\"glyphicon glyphicon-trash\" title=\"Usuń egzamin\"></i></a>";
			
			echo "</td>";
			
			echo "<td style=\"text-align: center;\">";
			if (!$exam->getActivated()) {
				echo "<button type=\"button\" id=\"row-activate-button-id-" . $i . "\" class=\"btn btn-success dropdown-toggle btn-sm\" style=\"width: 90px\"><b>Aktywuj</b></button>";
			}
			else {
				echo "<button type=\"button\" id=\"row-deactivate-button-id-" . $i . "\" class=\"btn btn-danger dropdown-toggle btn-sm\" style=\"width: 90px\"><b>Dezaktywuj</b></button>";
			}
			echo "</td>";
			
			echo "</tr>";
		
			$i++;
		}
		
		echo '
			<tbody>
		</table>
		';
	}

	include("html/End.php");
	ob_end_flush();
?>
