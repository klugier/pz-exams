<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - List studentów";
	$scripts = array("js/StudentListEdit.js");
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
	
	// echo '<span id="exam_id" style="visibility:hidden;">' . $id . '</span>'; // <- Potrzebujemy ten kod, bo robi strasznie duży górny margines!
?>

<div id="buttons">
	<span>
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#student_list_modal">Dodaj listę studentów</button>
		<button id="add_one_student" type="button" class="btn btn-primary btn-sm">Dodaj studenta</button> <!-- Czy to nie powinno być zrobione również na modalu??? -->
	</span>
</div>

<!-- Średnio mi te br w tym miejscu pasują, czy nie możemy dać po prostu margines> -->
<br/>
<br/>

<!-- Modal -->
<div class="modal fade" id="student_list_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Dodawanie listy studentów</h4>
      </div>
      <div class="modal-body">
        <div class="container col-md-12 col-sm-12" style="padding-left: 0px; padding-top: 0px;">
		<label for="student_list" class="col-sm-12 control-label" style="margin-top: 20px; padding-left: 0px;">Format: imię nazwisko &lt;adres e-mail&gt;</label>
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

<div>
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
			echo '<tr id="' . $student->getID() . '">';
			echo '<td id="number" style="text-align: center;">' . ($number+1) .  '.</td>';
			echo '<td id="firstname">' . $student->getFirstName() . '</td>';
			echo '<td id="lastname">' . $student->getSurname() . '</td>';
			echo '<td id="email">' . $student->getEmail() . '</td>';
			echo '<td style="text-align: center;">';
			
			echo '<a id="remove" title="Usuń studenta" style="cursor: pointer; margin-right: 5px;"><i class="glyphicon glyphicon-trash"></i></a>'; // <- To trzeba zaimplementować przy pomocy ajax-a...
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
