<?php
	include_once("lib/Lib.php");

	$title = "$appName - błąd 403 - brak dostępu";
	include("html/Begin.php");
	$previous=$_SERVER['HTTP_REFERER'];
?>
<div class="container response-error-code">
	<div class="col-xs-12 col-sm-12 col-md-12" >
		<img src="img/403.png" alt="">
		<h1>BŁĄD 403</h1>
		<h2>Brak dostępu</h2>
		<?php
			if(isset($previous)){
				echo '<a href="$previous">Powrót do poprzedniej strony</a>';
			}else{
				echo '<a href="index.php">Zapraszamy na stronę główną</a>';
			}
		?>
	</div>
</div>

