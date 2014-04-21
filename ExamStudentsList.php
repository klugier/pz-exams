<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - Edytuj listę studentów ";
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
?>


<h2> Edycja listy studentów </h2>

<?php
	$id = $_GET['examID'];

	echo '<span id="exam_id" style="visibility:hidden;">' . $id . '</span>';
?>

<div id="buttons" class="container col-md-10 col-md-offset-1" style="margin-top: 3%;">
<div class="container col-md-4" style="width: 28%; padding-left: 0%; padding-right: 0%;">
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#student_list_modal">Dodaj listę studentów</button>
<button id="add_one_student" type="button" class="btn btn-primary btn-sm">Dodaj studenta</button>
</div>
</div>

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

			<textarea class="form-control" rows="6" id="student_list"></textarea>

		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button id="add_students" type="button" class="btn btn-primary">Dodaj</button>
      </div>
    </div>
  </div>
</div>

<div class="container col-md-12 col-sm-12" style="padding-left: 0px; padding-right: 0px; margin-top: 5%;">

<div class="container col-md-10 col-md-offset-1">
<table class="table" id="students">
<thead>
		<tr>
		<th>Lp.</th>
		<th style="width: 20%;">Imię</th>
		<th style="width: 20%;">Nazwisko</th>
		<th>E-mail</th>
		<th style="text-align:center; vertical-align:middle;">Operacje</th>
		</tr>

</thead>
<tbody>
<!-- 	<tr>
		<td></td>
		<td>
			<div class="form-group" id="fn" style="margin-bottom: 0px;">
				<input id="firstname" type="text" class="form-control input-sm" style="width: 70%;"/>
			</div>
		</td>
		<td>
			<div class="form-group" id="ln" style="margin-bottom: 0px;">
				<input id="lastname" type="text" class="form-control input-sm" style="width: 70%;"/>
			</div>
		</td>
		<td>
			<div class="form-group" id="em" style="margin-bottom: 0px;">
				<input id="email" type="text" class="form-control input-sm" style="width: 70%;"/>
			</div>
		</td>
		<td style="text-align:center; vertical-align:middle;"><button id="add" class="btn btn-success btn-sm" style="width: 60%;">Dodaj</button></td>
	</tr> -->

<?php

	$studentIDList = RecordDatabase::getStudentIDList($id);
	$i = 0;

	$studentList = null;

	if (is_array($studentIDList)) {
		foreach ($studentIDList as $studentID) {
			$studentList[$i++] = StudentDatabase::getStudentByID($studentID);
		}
	}

	if (is_array($studentIDList)) {
	foreach ($studentList as $number => $student) {

		echo '<tr id="' . $student->getID() . '">';
		echo '<td id="number">' . ($number+1) .  '.</td>';
		echo '<td id="firstname">' . $student->getFirstName() . '</td>';
		echo '<td id="lastname">' . $student->getSurname() . '</td>';
		echo '<td id="email">' . $student->getEmail() . '</td>';
		echo '<td style="text-align:center; vertical-align:middle;">' .

		//<a><span id="edit" style="cursor: pointer;" title="Edit" class="glyphicon glyphicon-pencil"></span></a>

		'<a><span id="remove" title="Remove" class="glyphicon glyphicon-remove" style="margin-left: 10%; cursor: pointer;"></span></a></td>';
		echo '</tr>';

		}
	}

?>


</tbody>
</table>
</div>

</div>

<?php
	include("html/End.php");
	
	ob_end_flush();
?> 
