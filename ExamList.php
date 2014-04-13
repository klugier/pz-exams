<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - Lista egzaminów";
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
		echo '
		<table class="table">
			<thead>
				<tr>
					<th><center>Lp.</center></th>
					<th>Nazwa</th>
					<th><center>Aktywny</center></th>
					<th><center>Operacje</center></th>
					<th><center>Aktywacja</center></th>
				</tr>
			</thead>
			<tbody>
		';
		
		echo "<tr>\n";
		$i = 1;
		foreach ($exams as $exam) {
			echo "<tr>";
			echo "<td><center>" . $i . ".</center></td>\n";
			echo "<td>" . $exam->getName() . "</td>\n";
			
			// Activated
			echo "<td>";
			if ($exam->getActivated()) {
				echo "<center style=\"color: #156815;\"><b>Tak</b></center>";
			} else {
				echo "<center><b style=\"color: #801313;\">Nie</b></center>";
			}
			echo "</td>";
			
			// Options
			echo "<td><center>" .
				 "<a href=\"#\"><i class=\"glyphicon glyphicon-pencil\" style=\"margin-right: 10px;\"></i></a>" .
				 "<a href=\"#\"><i class=\"glyphicon glyphicon-trash\"></i></a>";
			
			// if ($
			

			echo "</center></td>";
			
			echo "<td><center>";
			if (!$exam->getActivated()) {
				echo "<button type=\"button\" class=\"btn btn-success dropdown-toggle btn-sm\"><b>Aktywuj</b></button>";
			}
			else {
				echo "<button type=\"button\" class=\"btn btn-danger dropdown-toggle btn-sm\"><b>Aktywuj</b></button>";
			}
			echo "</center></td>";
			
			echo "</tr>";
		
			$i++;
		}
		echo "</tr>\n";
	
		echo '
			<tbody>
		</table>
		';
	}

	include("html/End.php");
	ob_end_flush();
?>
