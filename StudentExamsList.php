<?php
	include_once("lib/Lib.php");
	
	$title = "$appName - Widok egzaminu";
	include("html/Begin.php");
	
	if (!isset($_GET['exam'])) {
		include("html/End.php");
		return;
	}

	$id   = $_GET['exam'];
	$exam = ExamDatabase::getExam($id);
	$examDays = ExamUnitDatabase::getExamDays($id);
	echo "<h2>";
	echo "<span>Informacje o egzaminie</span>";
	if ($examDays != null) {
		echo "<span style=\"float: right\"><a class=\"btn btn-primary btn-sm pull-right\" href=\"StudentExams.php?code=".$_GET['code']."\" title=\"Wróć do poprzedniej strony.\"><i class=\"glyphicon glyphicon-home\"></i> <b>Powrót</b></a></span>";
	}
	echo "</h2>";
	echo "<h4><i>(" . $exam->getName() . ")</i></h4><hr>";
	
	if ($examDays == null) {
		
		echo "<div class=\"alert alert-warning\"><strong>Niestety egzamin nie posiada aktualnie żadnych terminów!</strong></div>";

		include("html/End.php");
		
		return;
	}

	$uniqeDays = array_unique($examDays);
	$weekDays = array(1 => "Poniedziałek", 2 => "Wtorek", 3 => "Środa", 4 => "Czwartek", 5 => "Piątek", 6 => "Sobota", 0 => "Niedziela");
	
	foreach ($uniqeDays as $day) {
	echo "<h4 class=\"bg-info\">".$day." (".$weekDays[strftime('%w',strtotime($day))].")</h4>";
	echo '
		<table class="table table-condensed text-left">
			<thead>
				<tr class="row">
					<th class="col-md-1"><center>Lp.</center></th>
					<th class="col-md-2">Termin</th>
					<th class="col-md-8">Student</th>
				</tr>
			</thead>
			<tbody>
		';
	
	$i = 1;
	
	$examUnitIDList = ExamUnitDatabase::getExamUnitIDListDay($id, $day);

	foreach ($examUnitIDList as $examUnitID) {
		echo "<tr class=\"row\">";
		echo "<td class=\"text-center col-md-1\" style=\"vertical-align:middle;\">" . $i . ".</td>\n";

		$examunit = ExamUnitDatabase::getExamUnit($examUnitID);
		echo "<td class=\"col-md-2\" style=\"vertical-align:middle;\">" . $examunit->getTimeFrom()." - ". $examunit->getTimeTo() . "</td>\n";

		$record = RecordDatabase::getRecordFromUnit($examUnitID);
		if($record == NULL){
			echo "<td class=\"col-md-9\" style=\"vertical-align:middle;\"> ----- </td>\n";
		} else {
			$student = StudentDatabase::getStudentByID($record->getStudentID());
			if(($student->getFirstName() == NULL) || ($student->getFirstName() == "")){
				echo "<td class=\"col-md-9\" style=\"vertical-align:middle;\">" . $student->getEmail() . "</td>\n";
			} else {
				echo "<td class=\"col-md-9\" style=\"vertical-align:middle;\">" . $student->getFirstName() . " " . $student->getSurName() . "</td>\n";
			}
			$student = NULL;
		}

		$i++;
	}
	echo '
		<tbody>
	</table>
	<hr>
	';
	}

	include("lib/Dialog/StudentListPDFModal.php");
	include("html/End.php");
?>