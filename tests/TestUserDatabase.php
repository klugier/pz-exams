<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<?php
			include('../lib/Lib.php');
			$user = UserDatabase::getUser(1);
			if ($user == null) {
				echo "Następujący test zakończył się niepowodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
				echo DatabaseConnector::getLastError();
			}
			else {
				echo "$user->toString()"; 
			}
		?>
	</body>
</html>
