<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<?php
			include_once('../lib/Lib.php');
			
			$user = UserDatabase::getUser(1);
			if ($user == null) {
				echo "Następujący test zakończył się niepowodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
				echo DatabaseConnector::getLastError();
			}
			else {
				if ( $user->getEmail() == "test@uj.edu.pl"   ) {  
					echo "Następujący test zakończył się powodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
				} else { 
					echo "Następujący test zakończył się niepowodzeniem: \"UserDatabase::getUser(1);\"" . "<br \>";
				}
			}
		?>
	</body>
</html>
