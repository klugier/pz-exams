<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - List studentów";
	$scripts = array("js/StudentListEdit.js", "js/Lib/bootbox.min.js");
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/UserPanel.php");
	$id   = $_GET['examID'];
	$exam = ExamDatabase::getExam($id);
	
	echo "<h2>Lista studentów</h2>";
	echo "<h4><i>(" . $exam->getName() . ")</i></h4>";
	echo "<p>W tym miejscu znajduje się lista wszystkich studentów przypisanych do tego egzaminu. Przy pomocy przycisków możesz dodawać kolejnych studentów do listy.</p>";
	echo "<hr />";
?>

<div id="buttons">
	<span>
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#student_list_modal">Dodaj studentów</button>
		<button type="button" class="btn btn-warning btn-sm" id="sendEmails">Wyślij email do wszystkich <i class="glyphicon glyphicon-envelope"></i></button>
		<a class="btn btn-primary btn-sm pull-right" href="controler/PDFExamStudentsList.php?examID=<?php echo $exam->getID(); ?>" role="button" name="examStudentsListPDFGlyph" id="examStudentsListPDFGlyph" title="Pobierz PDF" value=<?php echo "\"".$exam->getID()."\""; ?>\><i class="glyphicon glyphicon-download"></i> <b>PDF</b></a>
	</span>
</div>


<!-- Modal - dodawanie listy studentów -->
<div class="modal fade" id="student_list_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Dodawanie studentów</h4>
      </div>
      <div class="modal-body">
      	<p id="exam_info" style="margin-top: 20px; text-align: justify;">
			Umieść w poniższym polu listę studentów, którzy mogą przystąpić do egzaminu. Poszczególne adresy oddzielaj określonym w formacie separatorem.
			Przed każdym z nich możesz opcjonalnie umieścić imię i nazwisko studenta.
		</p>
        <div id="student_input" class="container col-md-12 col-sm-12" style="padding-left: 0px; padding-top: 0px;">
			<label for="student_list" class="col-sm-12 control-label" style="margin-top: 20px; padding-left: 0px;">Format: <span id="char1">&lt;</span>adres e-mail<span id="char2">&gt;</span><span id="separator">,</span>
				<a id="changeChars" style="cursor: pointer;">Zmień</a>
			</label>
			<textarea class="form-control" rows="6" id="student_list" style="resize: vertical"></textarea>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button id="add_students" type="button" class="btn btn-primary">Dodaj</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal - end -->

<div style="margin-top: 5%;">
	<table class="table" id="students">
		<thead>
			<tr>
				<th style="text-align: center;">Lp.</th>
				<th style="width: 20%;">Imię</th>
				<th style="width: 20%;">Nazwisko</th>
				<th>E-mail</th>
				<th style="text-align:center;">Operacje</th>
			</tr>
		</thead>
	<tbody>
	
<?php
	$studentIDList = RecordDatabase::getStudentIDList($id);
	$studentList = null;
	
	if (is_array($studentIDList)) {
		$i = 0;
		foreach ($studentIDList as $studentID) {
			$studentList[$i++] = StudentDatabase::getStudentByID($studentID);
		}
	}

	if (is_array($studentIDList)) {
		foreach ($studentList as $number => $student) {
			echo '<tr class="student" id="' . $student->getID() . '">';
			echo '<td id="number" style="text-align: center;">' . ($number+1) .  '.</td>';

			$fName = "-";
			$lName = "-";

			if ($student->getFirstName() != "") {
				$fName = $student->getFirstName();
			}

			if ($student->getSurname() != "") {
				$lName = $student->getSurname();
			}

			echo '<td id="firstname">' . $fName . '</td>';
			echo '<td id="lastname">' . $lName . '</td>';
			echo '<td id="emails">' . $student->getEmail() . '</td>';
			echo '<td style="text-align: center;">';
			
			echo '<a title="Usuń studenta" style="cursor: pointer; margin-right: 5px;"><i id="remove" class="glyphicon glyphicon-trash"></i></a>'; // <- To trzeba zaimplementować przy pomocy ajax-a...
			echo '<a id="send" title="Wyślij wiadomość z kodem dostępu do studenta" style="cursor: pointer;"><i class="glyphicon glyphicon-envelope"></i></a>'; // <- To tak samo...
			echo '</td>';
			echo '</tr>';
		}
	}

?>
		</tbody>
	</table>
</div>

<?php
	include("html/End.php");
	
	ob_end_flush();
?> 
