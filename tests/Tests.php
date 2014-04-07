<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<div style="margin-top: -15px">
			<p style="float: left;"><b>Lista Testów</b></p>
			<p style="float: right;"><a href="../index.php">Powrót do strony głównej</a></p>
		</div>
		<div style="clear: both;"></div>
		<ul>
		<?php
			if ($handle = opendir('.')) {
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != ".." && $entry != basename(__FILE__) && $entry != "TestBegin.php" && $entry != "TestEnd.php") {
						echo "<li><a href='" . $entry . "'>" . $entry . "</a></li>\n";
					}
				}
				closedir($handle);
			}
		?>
		</ul>
	</body>
</html>
