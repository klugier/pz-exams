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
	$examsID = RecordDatabase::getExamIDList($student->getID());
	//echo '<pre>'; print_r($examsID); echo '</pre>';
	echo "<input id=\"studentID\" type=\"hidden\" value=\"";
	echo $id;
	echo "\">";
	echo "<span id=\"valueField\"></span>";
	
	
		echo '
		<table class="table">
			<thead>
				<tr>
					<th><center>Lp.</center></th>
					<th>Data Egzaminu</th>
					<th>Nazwa Egzaminu</th>
					<th><center>Status</center></th>
					<th><center>Zapisany</center></th>
					<th><center>Zapisz/Wypisz się</center></th>
				</tr>
			</thead>
			<tbody>
		';
	
		echo "<tr>\n";
		$i = 1;
		foreach ($examsID as $examID) {
			$exam = ExamDatabase::getExam($examID);
			if ($exam->getActivated()) {
			$examUnitList = ExamUnitDatabase::getExamUnitIDList($exam);
			$examDays = ExamUnitDatabase::getExamDays($examID);
			echo "<tr>";
			echo "<td><center>" . $i . ".</center></td>\n";
			// Dni aktywności egzamninu.
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
			echo "</td>\n";
			echo "<td>" . $exam->getName() . "</td>\n";
			//Liczba osób zapisanych
			echo "<td><center>";
				echo ExamUnitDatabase::countLockedExamUnits($examID);
				echo "/";
				echo count($examUnitList);
			echo "</center></td>\n";
			// Zapisany
			echo "<td>";
			$examUnitID=RecordDatabase::getExamUnitID($examID,$id);
			if ((($examUnitID) != null)&&(($examUnitID) != 0)) {
				echo "<center><button type=\"button\" class=\"btn btn-success active\">Tak</button></center>";
				echo "</td>";
				// Wypisz się (Button z id egzaminu)
				echo "<td><center>";
				echo "<a class=\"btn btn-info\" href=\"#\" role=\"button\" data-toggle=\"modal\" id=\"signOutGlyph\" data-target=\"#signOutModal\" title=\"Wypisz się\" value=\"".$exam->getID()."\"><i class=\"glyphicon glyphicon-remove\"></i></a>";
				echo "</center></td>";
			} else {
				echo "<center><button type=\"button\" class=\"btn btn-danger active\">Nie</button></center>";
				echo "</td>";
				echo "<td><center>";
				// Zapisz się (Button z id egzaminu)
				echo "<a class=\"btn btn-info\" href=\"#\" role=\"button\" data-toggle=\"modal\" name=\"signInGlyph\" id=\"signInGlyph\" data-target=\"#signInModal\" title=\"Zapisz się\" value=\"".$exam->getID()."\" examname=\"". $exam->getName() ."\"><i class=\"glyphicon glyphicon-plus\"></i></a>";
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