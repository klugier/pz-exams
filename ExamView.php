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
	echo "<h4><i>(" . $exam->getName() . ")</i></h4><hr>";

	$examDays = ExamUnitDatabase::getExamDays($id);
	$uniqeDays = array_unique($examDays);
	$weekDays = array(1 => "Poniedziałek", 2 => "Wtorek", 3 => "Środa", 4 => "Czwartek", 5 => "Piątek", 6 => "Sobota", 0 => "Niedziela");
	
	foreach ($uniqeDays as $day) {
	echo "<h4 class=\"bg-info\">".$day." (".$weekDays[strftime('%w',strtotime($day))].")</h4>";
	echo '
		<table class="table table-hover table-condensed text-left">
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
		echo "<td class=\"text-center col-md-1\" style=\"vertical-align:middle;\">" . $i . "</td>\n";

		$examunit = ExamUnitDatabase::getExamUnit($examUnitID);
		echo "<td class=\"col-md-2\" style=\"vertical-align:middle;\">" . $examunit->getTimeFrom()." - ". $examunit->getTimeTo() . "</td>\n";

		$record = RecordDatabase::getRecordFromUnit($examUnitID);
		if($record == NULL){
			echo "<td class=\"col-md-9\" style=\"vertical-align:middle;\"> ----- </td>\n";
		}else{
			$student = StudentDatabase::getStudentByID($record->getStudentID());
			if(($student->getFirstName() == NULL) || ($student->getFirstName() == "")){
				echo "<td class=\"col-md-9\" style=\"vertical-align:middle;\">" . $student->getEmail() . "</td>\n";
			}else{
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
	
	include("html/End.php");
?>

