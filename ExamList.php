<?php
	include_once("lib/Lib.php");
	$title = "$appName - Lista egzaminów";
	include("html/Begin.php");
	include("html/UserPanel.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		header('Location: index.php' ); 
	}

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
				echo "<center style=\"color: #801313;\"><b>Nie</b></center>";
			}
			echo "</td>";
			
			// Options
			echo "<td><center>" .
				"<a href=\"#\"><i class=\"glyphicon glyphicon-pencil\" style=\"margin-right: 10px;\"></i></a>" .
				"<a href=\"#\"><i class=\"glyphicon glyphicon-remove\"></i></a>" .
				"</center></td>";
			
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
?>
