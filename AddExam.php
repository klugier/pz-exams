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
	<?php
	include("html/ExamStage1.php");
	?>
</div>



<?php
	include("html/ExamStage2.php");
	include("html/ExamStage3.php");
	include("html/ExamSideMenuEnd.php");
	include("html/End.php");
?> 
