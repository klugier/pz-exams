<?php
	
	include_once("lib/Lib.php");
	$title = "$appName - Strona studenta - Lista egzaminów";
	$scripts = array(  "js/StudentRegister.js" );
	include("html/Begin.php");
	if(session_id() == '') {
		session_start();
	}
?>

<div id="stages">
	<?php
		include("html/StudentExamsMain.php");
	?>
</div>

<?php
	include("html/End.php");
?>