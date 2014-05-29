<?php

	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - List studentów";
	$scripts = array("js/Lib/bootbox.min.js", "js/Lib/spin.min.js", "js/Lib/ladda.min.js", "js/AdminEdit.js");
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
	
		ob_end_flush();
		return;
	}

	$user = unserialize($_SESSION['USER']);
	
	if (!$user->getRight()=="administrator") {
		echo "<div class=\"alert alert-danger\"><b>Brak uprawnień</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/AdminPanel.php");

	$xml=simplexml_load_file("cfg/Settings.xml");

	echo "<h2>Edycja ustawień portalu</h2>";
	echo "<p>W tym miejscu można edytować ustawienia portalu.</p>";
	echo "<hr>";

	echo '<form class="form-horizontal" role="form" id="admin_form" method="post" action="controler/HandlingSettingsEdit.php">
	<fieldset class="col-xs-12	col-sm-12	col-md-12">';

	echo '<h4>Debug Mode</h4>';
	echo 'Włączony?: <input type="checkbox" '.($xml->Debug == 1 ? "checked=checked" : "").'>';
	echo '<hr>';

	echo '<h4>Dostępne Domeny</h4>';
	echo '
	<p>
		<label>Dodaj Domenę
			<input type="text" id="add_domain" />
		</label>
		<button class="button" id="add">Dodaj</button>
	</p> 
	<form action="" method="post">
		<ul id="domains">';
	foreach( $xml->Domains->children() as $child) {
		$listitem_html = '<li>'.$child.'<input type="hidden" name="Domains[]" value="' . $child . '" /> '.'<a href="#" class="remove_domain">Usuń</a>'.'</li>';
		echo $listitem_html;
	}
	echo '</ul>
		<input class="button" type="submit" value="Zapisz">
	</form>';
	echo '<hr>';

	echo '<h4>Ustawienia E-mail</h4><br>';
	foreach( $xml->Email->children() as $child) {
?>
	<div class="form-group">
		<label for="<?php echo strtolower($child->getName());?>" class="col-xs-1	col-sm-1	col-md-1	control-label"><?php echo $child->getName(); ?></label>
			<div class="col-xs-4	col-sm-4	col-md-4">
				<input type="text" class="form-control" id="<?php echo strtolower($child->getName());?>" name="nameEdit" value="<?php echo $child; ?>">
		</div>
	</div><br>
<?php
	}
	echo '<hr>';

	echo '<h4>Ustawienia Autoryzacji</h4><br>';
	foreach( $xml->Authorization->children() as $child) {
?>
	<div class="form-group">
		<label for="<?php echo strtolower($child->getName());?>" class="col-xs-1	col-sm-1	col-md-1	control-label"><?php echo $child->getName(); ?></label>
			<div class="col-xs-4	col-sm-4	col-md-4">
				<input type="text" class="form-control" id="<?php echo strtolower($child->getName());?>" name="nameEdit" value="<?php echo $child; ?>">
		</div>
	</div><br>
<?php
	}
	echo '<hr>';
?>
<div class="form-group">
			<span class="col-xs-3 col-sm-3	col-md-3">
				<button type="submit" class="btn	btn-primary" name="submitButton" value="submit">Zapisz ustawienia</button>
			</span>
		</div>
	</fieldset>
</form>
<?php
	//echo '<pre>';
	//print_r($xml);
	//echo '</pre>';

	include("html/End.php");
	
	ob_end_flush();
?>