<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - Edytuj egzamin ";
	$scripts = array(  "js/CalendarManager.js" );
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


<h2> Edycja Egzaminu </h2>
<div id="stages">
	<?php
		include("html/ExamStage1.php");
	?>
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
