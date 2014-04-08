<?php 
	include_once("lib/Lib.php");
	$title = "$appName - Dodaj egzamin - Podstawowe dane";
	$scripts = array(  "js/CalendarManager.js" , "js/AddExam.js" );
	include("html/Begin.php");
	include("html/UserPanel.php");
	
	$examSideMenuAcctualStep = 0;
	include("html/ExamSideMenuBegin.php");
?>

<div id="stages">

<div id="stage1">

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

</div>

<?php
	include("html/ExamStage2.php");
	include("html/ExamStage3.php");
	include("html/ExamSideMenuEnd.php");
	include("html/End.php");
?> 
