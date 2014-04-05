<?php
	include_once("lib/Lib.php");
	$title = "$appName - Lista egzaminów";
	include("html/Begin.php");
	include("html/UserPanel.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		header('Location: index.php' ); 
	}
?>

<table class="table">
	<thead>
		<tr>
			<th><center>Lp.</center></th>
			<th>Nazwa</th>
			<th><center>Aktywowany</center></th>
			<th><center>Operacje</center></th>
		</tr>
	</thead>
	<tbody>
	
	<?php
		$id = unserialize($_SESSION['USER'])->getID();
		$exams = ExamDatabase::getExamList($id);
		echo "<tr>\n";
		$i = 1;
		foreach ($exams as $exam) {
			echo "<tr>";
			echo "<td><center>" . $i . ".</center></td>\n";
			echo "<td>" . $exam->getName() . "</td>\n";
			
			// Activated
			echo "<td>";
			if ($exam->getActivated()) {
				echo "<center>Tak</center>";
			}
			else {
				echo "<center>Nie</center>";
			}
			echo "</td>";
			
			// Options
			echo "<td><center>" .
				 "<i class=\"glyphicon glyphicon-pencil\" style=\"margin-right: 10px;\"></i>" .
				 "<i class=\"glyphicon glyphicon-remove\"></i>" .
				 "</center></td>";
			
			echo "</tr>";
			
			$i++;
		}
		echo "</tr>\n";
	?>
	
	<tbody>
</table>

<?php
	include("html/End.php");
?>
