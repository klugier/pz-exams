<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<?php
			include_once('../lib/Lib.php');
			
			$exam = ExamDatabase::getExamList(1);
			$examNum = ExamDatabase::getExamNum(1);
			if ($exam == null) {
				echo "Następujący test zakończył się niepowodzeniem: \"ExamDatabase::getExamDatabase(1);\"" . "<br \>";
				echo DatabaseConnector::getLastError();
			}else{
				echo $examNum . "<br/>";
				for($i=0;$i<count($exam);$i++)
					echo $exam[$i]->getID() . ", " .
					     $exam[$i]->getUserID() . ", " .
						 $exam[$i]->getName() . ", " .
						 $exam[$i]->getDuration() . "<br/>";
			}
		?>
	</body>
</html>
