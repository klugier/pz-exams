<!DOCTYPE HTML>

<html>
	<head>
		<?php
			if (isset($title)) {
				echo "<title>$title</title>";
			}
		?>
		
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		<?php
			if (isset($csses)) {
				foreach ($csses as $value) {
					echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$value\">";
				}
			}
		?>
		
		
		<?php
			$dataPrinted = false;
			if (isset($scripts)) {
				foreach ($scripts as $value) {
					echo "<script language=\"javascript\" type=\"text/javascript\" src=\"$value\"></script>";
					if ($dataPrinted == false) {
						$dataPrinted = true;
					}
				}
			}
			if (isset($scriptsDefer)) {
				foreach ($scriptsDefer as $value) {
					echo "<script language=\"javascript\" type=\"text/javascript\" src=\"$value\" defer></script>";
					if ($dataPrinted == false) {
						$dataPrinted = true;
					}
				}
			}
			if ($dataPrinted == true) {
				echo "\n";
			}
		?>
	</head>

	<body style="background-image: url('img/books.jpg'); padding-top: 70px;">
		<?php include_once("Navbar.php"); ?>
		<div style="min-height: 92%; height: auto !important; height: 100%; margin: 0 auto 0;">
			<div class="container col-md-8 col-md-offset-2" style="padding: 0px; padding-top:0px;">
				<div class="panel col-md-12" style="padding: 20px; background: rgba(255, 255, 255, 0.9);">
