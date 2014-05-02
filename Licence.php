<?php
	
	include_once("lib/Lib.php");
	
	$title = "$appName - Pomoc";
	$scripts = array("js/LicenceHelp.js");
	include("html/Begin.php");

	echo '<div class="container">
		<h2>Licencje użytych technologii.</h2>';
	echo '<div class="panel panel-primary">
			<div class="panel-heading" id="0">
				<h3 class="panel-title">SecureImage</h3>
			</div>
			<div class="panel-body" id="b0" style="display: none;">';
				$filename = "lib\SecureImage\LICENSE.txt";
				$fp = fopen($filename, "r");
				$content = fread($fp, filesize($filename));
				$lines = explode("\n", $content);
				fclose($fp);
				foreach ($lines as $line) {
					echo $line . "<br>";
				}
	echo'</div></div>';

	echo '<div class="panel panel-primary">
			<div class="panel-heading" id="1">
				<h3 class="panel-title">PHPMailer</h3>
			</div>
			<div class="panel-body" id="b1" style="display: none;">';
				$filename = "lib\Utility\Mail\README.md";
				$fp = fopen($filename, "r");
				$content = fread($fp, filesize($filename));
				$lines = explode("\n", $content);
				fclose($fp);
				foreach ($lines as $line) {
					echo $line . "<br>";
				}
	echo'</div></div>';

	echo '<div class="panel panel-primary">
			<div class="panel-heading" id="2">
				<h3 class="panel-title">tFPDF</h3>
			</div>
			<div class="panel-body" id="b2" style="display: none;">';
				$filename = "lib/Utility/PDF/info.htm";
				$fp = fopen($filename, "r");
				$content = fread($fp, filesize($filename));
				$lines = explode("\n", $content);
				fclose($fp);
				foreach ($lines as $line) {
					echo $line;
				}
	echo'</div></div>';
	echo '</div>';

	include ("html/End.php");
?>