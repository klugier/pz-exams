<?php 
	include_once("lib/Lib.php");
	$title = "$appName - Dodaj egzamin - Podstawowe dane";
	$scripts = array(  "js/CalendarManager.js" , "js/AddExam.js" );
	include("html/Begin.php");
	include("html/UserPanel.php");
	
	$examSideMenuAcctualStep = 0;
	include("html/ExamSideMenuBegin.php");
?>

<div class="tab-content">
	<div></div>

	<div class="tab-pane fade in active" id="data" style="padding-left: 20px;">

	<h2>Dane o egzaminie</h2>

	<div class="container col-md-12">

	<form role="form" class="form-horizontal" style="margin-top: 20px;">

	<div class="form-group" id="exam_name_group">
		<label for="exam_name" class="col-sm-3 control-label">Nazwa egzaminu</label>
		<div class="col-sm-6 col-md-4">
			<input type="text" class="form-control" id="exam_name" placeholder="" maxlength="200">
		</div>
	</div>

	<div class="form-group" id="duration_group">
		<label for="duration" class="col-sm-3 control-label">Czas trwania egzaminu (minuty)</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="duration" placeholder="" maxlength="2">
		</div>
	</div>

	</form>
	
	<div class="row"> 
		<div id="calendar-control"> 
			
		</div> 
	</div>
	<?php
	include("lib/Dialog/ModalButton.php");
	?>
	<span class="pull-right">
		<button type="button" class="btn btn-primary" id="next1">Dalej</button>
	</span>

</div>

</div>

<!--
Trzeba to przenieś do osobnego pliku.
Każdy plik powinien zawierać jedną opcję z bocznego menu
<div class="tab-pane fade" id="students" style="padding-left: 20px; padding-right: 20px;">

	<h2>Lista studentów</h2>

	<p id="exam_info" style="margin-top: 20px;"></p>

	<label for="duration" class="col-sm-12 control-label" style="margin-top: 20px; padding-left: 0px;">Format: imię nazwisko &lt;adres e-mail&gt;</label>
		
	<div class="container col-md-12" style="padding-left: 0px;">
	
	<div class="container col-md-6" style="padding-left: 0px; padding-top: 0px;">
			<textarea class="form-control" rows="3" id="student_list"></textarea>

			<span class="pull-right">
				<button type="button" class="btn btn-primary btn-sm" id="add_students" style="margin-top: 10px;">Dodaj</button>
			</span>
		</div>

		<div class="container col-md-5" id="student_data"></div>

		</div>

		<div class="container col-md-12" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;">
		
		<hr/>

		<span class="pull-left">
			<button type="button" class="btn btn-primary" id="prev1">Cofnij</button>
		</span>

		<span class="pull-right">
			<button type="button" class="btn btn-primary" id="next2">Zatwierdź</button>
		</span>

		</div>

		</div>

	</div>
-->

<?php
	include("html/ExamSideMenuEnd.php");
	include("html/End.php");
?> 
