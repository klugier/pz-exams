<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<?php
			include_once('../lib/Lib.php');
			
			$exam = ExamDatabase::getExamNum(1);
			if ($exam == null) {
				echo "Następujący test zakończył się niepowodzeniem: \"ExamDatabase::getExamDatabase(1);\"" . "<br \>";
				echo DatabaseConnector::getLastError();
			}else{
				for($i=0;$i<count($exam);$i++)
					echo $exam->getID() . ", " .
					     $exam->getUserID() . ", " .
						 $exam->getName() . ", " .
						 $exam->getDuration() . "<br/>";
			}
		?>
	</body>
</html>
