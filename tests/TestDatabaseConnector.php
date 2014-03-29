<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<?php
			include_once('../lib/Lib.php');
			
			if (DatabaseConnector::isConnected()) {
				echo "Połączenie z bazą danych działa poprawnie. <br \>\n";
			} else {
				
			}
		?>
	</body>
</html>
 
