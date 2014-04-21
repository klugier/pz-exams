<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - Edytuj egzamin ";
	$scripts = array(  "js/CalendarManager.js" , "js/ExamEdit.js" );
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

<div class="container col-md-12">
	<h2>Edycja Egzaminu</h2>
	<hr/>
	<form role="form" class="form-horizontal" >

		<div class="form-group" id="exam_name_group">
			<label for="exam_name" class="control-label col-sm-3 col-md-3">Nazwa egzaminu</label>
			<div class="col-sm-4 col-md-4">
				<input type="text" class="form-control" id="exam_name" placeholder="Zmień nazwę" maxlength="120" >
			</div>
		</div>


		<div class="form-group" id="duration_group">
			<label for="duration" class="control-label col-sm-3 col-md-3">Czas trwania egzaminu (minuty)</label>

			<div class="col-sm-4 col-md-4">
				<input type="number" name="duration" class="form-control" id="exam_duration" placeholder="Zmień czas trwania" maxlength="2" min="0" max="100">
			</div>
		</div>
	</form>
	<div class="row col-md-11" style="float:none;margin:0 auto;"> 
			<br />
				<div id="calendar-control"> 
				<!-- here goes calendar content --> 
				</div>
			<br />
			<?php
				include("lib/Dialog/ModalButton.php");
			?>
	</div>
	<hr/>
</div>

<script type="text/javascript">
	// loads calendar from database --> first CalendarManager script is  run
	$(document).ready(function () {
		editExamCalendarManager.sendAjaxExamCalendarRequest();
		editExamCalendarManager.printCalendar();
	});
</script>

<?php
	include("html/End.php");
	
	ob_end_flush();
?> 
