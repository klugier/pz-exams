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
	<thread>
		<th>#</th>
		<th>Nazwa</th>
	</thead>
	<tbody>
	
	<?php
		$id = unserialize($_SESSION['USER'])->getID();
		$exams = ExamDatabase::getExamList($id);
		echo "<tr>\n";
		$i = 1;
		foreach ($exams as $exam) {
			echo "<tr>";
			echo "<td>" . $i . "</td>\n";
			echo "<td>" . $exam->getName() . "</td>\n";
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
