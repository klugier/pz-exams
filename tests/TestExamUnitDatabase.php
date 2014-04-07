<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
		<?php
			include_once('../lib/Lib.php');
			
			$testExam = new Exam;
			$testExam->setID(15);
			$testExamUnit = new ExamUnit;
			$testExamUnit->setDay('2014-04-09');
			$testExamUnit->setTimeFrom('09:00:00');
			$testExamUnit->setTimeTo('14:00:00');
			$testExamUnit->setState('unlocked');
			
			if(ExamUnitDatabase::insertExamUnit($testExam,$testExamUnit)){
				echo "Done and Done <br/>";
			}else{
				echo "nope <br/>";
			}
			
			$testExamUnit->setID(ExamUnitDatabase::getExamUnitID($testExam));
			
			$testExamUnit->setState('locked');
			$testExamUnit->setTimeTo('17:00:00');
			
			
			if(ExamUnitDatabase::updateExamUnit($testExamUnit)){
				echo "updated";
			}else{
				echo "Something went Wrong<br/>";
			}
			
			
			if(ExamUnitDatabase::deleteExamUnit($testExamUnit)){
				echo "There's no more evidence of ". $testExamUnit->getID() . "<br/>";
			}else{
				echo "nope<br/>";
			}
			
		?>
	</body>
</html>
