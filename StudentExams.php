<?php
	include_once("lib/Lib.php");
	$title = "$appName - Strona studenta - List egzaminów";
	$scripts = array("js/StudentRegister.js");
	include("html/Begin.php");
	
	$arrLocales = array('pl_PL', 'pl','Polish_Poland.28592');
	setlocale(LC_ALL, $arrLocales);
	
	echo "<input id=\"studentCode\" type=\"hidden\" value=\"";
	echo $_GET['code'];
	echo "\">";
	$student = StudentDatabase::getStudentByCode($_GET['code']);
	$id = $student->getID();

	if ($id == null) {
		echo "<div class=\"alert alert-danger text-center\"><b>Kod niepoprawny.</b> Za 5 sekund zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 5; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}

	$examsID = RecordDatabase::getExamIDList($student->getID());
	$active = 1;
	foreach ($examsID as $examID) {
		$exam = ExamDatabase::getExam($examID);
		$examDays = ExamUnitDatabase::getExamDays($examID);
		if ($exam->getActivated()&&(date_create($examDays[count($examDays)-1]) > new DateTime("now"))) {
			$active = 0;
		}
	}
	if($active == 1){
		echo "<div class=\"alert alert-info text-center\"><b>Brak aktywnych egzaminów.</b><br> Aktualnie nie masz egzaminów na które możesz się zapisać. Wróć później.</div>";
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	//echo '<pre>'; print_r($examsID); echo '</pre>';
	echo "<input id=\"studentID\" type=\"hidden\" value=\"";
	echo $id;
	echo "\">";
	echo "<span id=\"valueField\"></span>";
	
	echo "<h2>Lista aktualnych egzaminów</h2>";
	echo "<p>W tym miejscu możesz przejrzeć listę swoich aktualnych egzaminów.</p>";
	echo "<hr />";
	
		echo '
		<table class="table table-hover table-condensed text-left">
			<thead>
				<tr>
					<th><center>Lp.</center></th>
					<th>Data Egzaminu</th>
					<th>Nazwa Egzaminu</th>
					<th><center>Status</center></th>
					<th><center>Zapisz/Wypisz się</center></th>
				</tr>
			</thead>
			<tbody>
		';
		
		$i = 1;
		foreach ($examsID as $examID) {
			$exam = ExamDatabase::getExam($examID);
			$examDays = ExamUnitDatabase::getExamDays($examID);
			// TODO: Blok IF nie posiada wcięcia!!!
			if (($exam->getActivated())&&(date_create($examDays[count($examDays)-1]) > new DateTime("now"))) {
			$examUnitList = ExamUnitDatabase::getExamUnitIDList($exam);
			$examUnitID=RecordDatabase::getExamUnitID($examID,$id);
			if ((($examUnitID) != null)&&(($examUnitID) != 0)) {	
				echo "<tr class=\"info\">";
			}else{
				echo "<tr class=\"danger\">";
			}
			echo "<td class=\"text-center\" style=\"vertical-align:middle;\">" . $i . ".</td>\n";
			// Dni aktywności egzamninu.
				if ((($examUnitID) != null)&&(($examUnitID) != 0)) {
					echo "<td style=\"vertical-align:middle;\"><b>";
					$eu = ExamUnitDatabase::getExamUnit($examUnitID);
					echo $eu->getDay();
					$time = $eu->getDay()." ".$eu->getTimeFrom();
					echo " (".iconv("ISO-8859-2","UTF-8",ucfirst(strftime('%A',strtotime($time)))).") ";
					echo " o ".strftime("%H:%M",strtotime($time));
					echo "</b>";
				}else{
					echo "<td style=\"vertical-align:middle;\">";
					$j = 0;
					$uniqeDays = array_unique($examDays);
					//echo '<pre>'; print_r($uniqeDays); echo '</pre>';
					foreach ($uniqeDays as $day){
						if($j == 0){
							echo $day;
						}elseif($j == count($uniqeDays)-1){
							echo date("/d",strtotime($day));
						}
						$j++;
					}
				}
			echo "</td>";
			echo "<td style=\"vertical-align:middle;\">" . $exam->getName() . "</td>";
			//Liczba osób zapisanych
			$locked = ExamUnitDatabase::countLockedExamUnits($examID);
			$total = count($examUnitList);
			$percent = ((100*$locked)/count($examUnitList));
			// Zapisany
			if ((($examUnitID) != null)&&(($examUnitID) != 0)) {
				echo "<td  class=\"col-md-3\"><div class=\"progress fake-center\">";
				echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $percent%\">";
				echo "<span style=\"height:20px;\"><b style=\"vertical-align:middle;\">$locked/$total - Zapisany</b></span>";
				echo "</div></div></td>";
				// Wypisz się (Button z id egzaminu)
				echo "<td class=\"text-center\">";
				echo "<a class=\"btn btn-danger fake-center-button\" href=\"#\" role=\"button\" data-toggle=\"modal\" id=\"signOutGlyph\" data-target=\"#signOutModal\" title=\"Wypisz się\" value=\"".$exam->getID()."\"><i class=\"glyphicon glyphicon-remove\"></i></a>";
				echo "</td>";
			} else {
				if($total != $locked){
					echo "<td  class=\"col-md-3\"><div class=\"progress fake-center\">";
					echo "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $percent%\">";
					echo "<span><b style=\"vertical-align:middle;\">$locked/$total - Niezapisany</b></span>";
					echo "</div></div></td>";
					// Zapisz się (Button z id egzaminu)
					echo "<td class=\"text-center\">";
					echo "<a class=\"btn btn-success fake-center-button\" href=\"#\" role=\"button\" data-toggle=\"modal\" name=\"signInGlyph\" id=\"signInGlyph\" data-target=\"#signInModal\" title=\"Zapisz się\" value=\"".$exam->getID()."\" examname=\"". $exam->getName() ."\"><i class=\"glyphicon glyphicon-plus\"></i></a>";
					echo "</td>";
				}else{
					echo "<td  class=\"col-md-3\"><div class=\"progress fake-center\">";
					echo "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $percent%\">";
					echo "<span><b style=\"vertical-align:middle;\">$locked/$total - Niezapisany - Brak Miejsc</b></span>";
					echo "</div></div></td>";
					// Zapisz się (Button z id egzaminu)
					echo "<td class=\"text-center\">";
					echo "<a class=\"btn btn-success fake-center-button\" href=\"#\" role=\"button\" disabled=\"disabled\" data-toggle=\"modal\" name=\"signInGlyph\" id=\"signInGlyph\" data-target=\"#signInModal\" title=\"Zapisz się\" value=\"".$exam->getID()."\" examname=\"". $exam->getName() ."\"><i class=\"glyphicon glyphicon-plus\"></i></a>";
					echo "</td>";
				}
			}
			$i++;
			}
		}
	
	echo '
		<tbody>
	</table>
	';
	
	include("lib/Dialog/ExamSignOutButton.php");
	include("lib/Dialog/ExamSignInButton.php");
	include("html/End.php");
?>