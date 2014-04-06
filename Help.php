<?php 
	include_once("lib/Lib.php");

	$title = "$appName - Pomoc";
	include("html/Begin.php");
?> 

<div class="container"> 
	<h2>Obsługiwane domeny</h2>
	W chwili obecnej obsługujemy następujące domeny: <br />
	<ul>
		<?php
			$domains = Settings::getDomains();
			if ($domains == null) {
				echo "<li><b>Aktualnie obsługiwane są wszystkie domenu</b></li>";
			} else {
				foreach ($domains as $domain) {
					echo "<li>" . $domain . "</li>\n";
				}
			}
		?>
	</ul>
	
</div>

<?php include ("html/End.php"); ?>
