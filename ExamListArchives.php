<?php
	ob_start();
	include_once("lib/Lib.php");
	
	function finish() {
		include("html/End.php");
		ob_end_flush();
	}
	
	$title = "$appName - Lista archiwalnych egzaminów";
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/UserPanel.php");
	
	$userID = unserialize($_SESSION['USER'])->getID();
	$exams = ExamDatabase::getExamList($userID);
	
	if ($exams == null) {
		echo "<div class=\"alert alert-info\">";
		echo "<b>Nie dodałeś jeszcze żadnych egzaminów!</b> Zobacz jakie to proste i <u><b><a href=\"AddExam.php\">utwórz</a></b></u> swój pierwszy egzamin.";
		echo "</div>";
		
		finish();
		return;
	}
	
	date_default_timezone_set('Europe/Warsaw');
	$currentDate = date("Y-m-d");
	
	// Przygotujmy posortowaną listę egzaminów względem daty rozpoczęcia
	$list = null;
	$i = 0;
	foreach ($exams as $exam) {
		$list[$i] = new ExamListElement($exam, ExamUnitDatabase::getExamDays($exam->getID()));
		$i++;
	}
	ExamListElement::sortByStartDate($list);
	
	// Sprawdzamy czy przypadkiem listę, którą będziemy wyświetlać nie będzie pusta
	$isEmpty = true;
	foreach ($list as $element) {
		$examDays = $element->getExamDates();
		$examDaysSize = sizeof($examDays);
		
		if ($examDays != null) {
			if ($currentDate > $examDays[$examDaysSize - 1]) {
				$isEmpty = false;
				break;
			}
		}
	}
	if ($isEmpty) {
		echo "<div class=\"alert alert-info\">";
		echo "<b>W chwili obecnej nie posiadasz żadnych archiwalnych egzaminów!</b> Możesz przejrzeć <b><u><a href=\"ExamList.php\">listę atkualnych egzaminów</a></u></b> lub <b><u><a href=\"AddExam.php\">dodać nowy egzamin</a></b></u>.";
		echo "</div>";
		
		finish();
		return;
	}
	
	echo "<h2>Lista archiwalnych egzaminów</h2>";
	echo "<p>W tym miejscu możesz przejrzeć listę swoich archiwalnych egzaminów.</p>";
	echo "<hr />";
	
	echo '
	<table class="table">
		<thead>
			<tr>
				<th style="text-align: center">Lp.</th>
				<th>Nazwa</th>
				<th style="text-align: center">Data rozpoczęcia<i class="glyphicon glyphicon-chevron-down" style="margin-left: 5px"></i></th>
				<th style="text-align: center">Data zakończenia</th>
				<th style="text-align: center" title="Zapisani studenci / Wprowadzeni studenci / Liczba miejsc">Zapełnienie</th>
			</tr>
		</thead>
		<tbody>
	';
	
	$i = 1;
	foreach ($list as $element) {
		$id           = $element->getExam()->getID();
		$name         = $element->getExam()->getName();
		$examDays     = $element->getExamDates();
		$examDaysSize = sizeof($examDays);
		
		// Is archive exam echeck
		if ($examDays == null) {
			continue;
		} else {
			if ($currentDate < $examDays[$examDaysSize - 1]) {
				continue;
			}
		}
		
		$echoRowDefault = "<tr id=\"row-id-" . $id . "\">";
		
		// Lp.
		echo "<td id=\"row-lp-" . $i . "\" style=\"text-align: center;\">" . $i . ".</td>\n";
		
		// Name
		echo "<td id=\"row-name-id-" . $id . "\"><a href=\"ExamView.php?id=" . $id . "\" style=\"color: #000\">" . $name . "</a></td>\n";
		
		// Dates
		if ($examDays == null) {
			echo "<td style=\"text-align: center\">Brak</td>";
			echo "<td style=\"text-align: center\">Brak</td>";
		} else {
			echo "<td style=\"text-align: center\">" . $examDays[0] . "</td>";
			if ($examDaysSize == 0) {
				echo "<td style=\"text-align: center\">Brak</td>";
			} else {
				echo "<td style=\"text-align: center\">" . $examDays[$examDaysSize - 1] . "</td>";
			}
		}
		
		// Populating
		echo "<td style=\"text-align: center\"><span title=\"Liczba zapisanych studentów\">" . ExamUnitDatabase::countLockedExamUnits($id)  . "</span>/<span title=\"Liczb studentów\">" . RecordDatabase::countStudentsByExam($id) . "</span>/<span title=\"Liczba miejsc\">" . ExamUnitDatabase::countExamUnits($id) . "</span></td>";
		
		echo "</tr>";
		
		$i++;
	}
	
	echo '
		<tbody>
	</table>
	';
	
	finish();
?>
