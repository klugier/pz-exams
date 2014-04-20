<?php

	if(isset($_POST['student_id']) && isset($_POST['exam_id']))
	{
		include_once("../../lib/Lib.php");

		$result_info = array();

		$exam_id = $_POST['exam_id'];
		$student_id = $_POST['student_id'];

		$record = new Record();
		$record->setID(RecordDatabase::getRecordID($exam_id, $student_id));

		header('Content-Type: application/json');

		if(RecordDatabase::deleteRecord($record)) {

			array_push($result_info, true);

			$student = new Student();
			$student->setID($student_id);

			if(StudentDatabase::deleteStudent($student))
			{
				array_push($result_info, true);
			}
			else
			{
				array_push($result_info, false);
			}
		} else {
			array_push($result_info, false);
		}

		echo json_encode($result_info);

	}


?>