<?php
	
	include_once("lib/Lib.php");
	$title = "$appName - Strona studenta - Lista egzaminów";
	$scripts = array(  "js/StudentRegister.js" );
	include("html/Begin.php");
	if(session_id() == '') {
		session_start();
	}
	
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
		if ($exam->getActivated()&&(date_create($examDays[0]) > new DateTime("now"))) {
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
		';//<th><center>Zapisany</center></th>
	
		echo "<tr>\n";
		$i = 1;
		foreach ($examsID as $examID) {
			$exam = ExamDatabase::getExam($examID);
			$examDays = ExamUnitDatabase::getExamDays($examID);
			if (($exam->getActivated())&&(date_create($examDays[0]) > new DateTime("now"))) {
			$examUnitList = ExamUnitDatabase::getExamUnitIDList($exam);
			$examUnitID=RecordDatabase::getExamUnitID($examID,$id);
			if ((($examUnitID) != null)&&(($examUnitID) != 0)) {	
				echo "<tr class=\"info\">";
			}else{
				echo "<tr class=\"danger\">";
			}
			echo "<td class=\"center vcenter\">" . $i . ".</td>\n";
			// Dni aktywności egzamninu.
				if ((($examUnitID) != null)&&(($examUnitID) != 0)) {
					echo "<td><b>";//style=\"text-decoration:underline\"
					$eu = ExamUnitDatabase::getExamUnit($examUnitID);
					echo $eu->getDay();
					echo " o ".$eu->getTimeFrom();
				}else{
					echo "<td>";
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
			echo "<td>" . $exam->getName() . "</td>";
			//Liczba osób zapisanych
			$locked = ExamUnitDatabase::countLockedExamUnits($examID);
			$total = count($examUnitList);
			$percent = ((100*$locked)/count($examUnitList));
				//echo ;
				//echo "/";
				//echo count($examUnitList);
			// Zapisany
			if ((($examUnitID) != null)&&(($examUnitID) != 0)) {
				//echo "<td>";
				//echo "<center><div class=\"btn btn-info active btn-xs\"><b>Tak</b></div></center>";
				//echo "</td>";
				echo "<td class=\"col-md-3\"><center><div class=\"progress\">";
				echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $percent%\">";
				echo "<span><b>$locked/$total - Zapisany</b></span>";
				echo "</div></div></center></td>";
				// Wypisz się (Button z id egzaminu)
				echo "<td><center>";
				echo "<a class=\"btn btn-danger \" href=\"#\" role=\"button\" data-toggle=\"modal\" id=\"signOutGlyph\" data-target=\"#signOutModal\" title=\"Wypisz się\" value=\"".$exam->getID()."\"><i class=\"glyphicon glyphicon-remove\"></i></a>";
				echo "</center></td>";
			} else {
				//echo "<td>";
				//echo "<center><div class=\"btn btn-info active btn-xs\"><b>Nie</b></div></center>";
				//echo "</td>";
				echo "<td class=\"col-md-3\"><center><div class=\"progress\">";
				echo "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"$percent\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $percent%\">";
				echo "<span><b>$locked/$total - Niezapisany</b></span>";
				echo "</div></div></center></td>";
				// Zapisz się (Button z id egzaminu)
				echo "<td><center>";
				echo "<a class=\"btn btn-success \" href=\"#\" role=\"button\" data-toggle=\"modal\" name=\"signInGlyph\" id=\"signInGlyph\" data-target=\"#signInModal\" title=\"Zapisz się\" value=\"".$exam->getID()."\" examname=\"". $exam->getName() ."\"><i class=\"glyphicon glyphicon-plus\"></i></a>";
				echo "</center></td>";
			}
			echo "</tr>";
			$i++;
			}
		}
		echo "</tr>\n";
	
		echo '
			<tbody>
		</table>
		';
	include("lib/Dialog/ExamSignOutButton.php");
	include("lib/Dialog/ExamSignInButton.php");
	include("html/End.php");
?>