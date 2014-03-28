<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
	<b>Lista testów</b>
		<ul>
		<?php
			if ($handle = opendir('.')) {
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != ".." && $entry != basename(__FILE__)) {
						echo "<li><a href='" . $entry . "'>" . $entry . "</a></li>\n";
					}
				}
				closedir($handle);
			}
		?>
		</ul>
	</body>
</html>
