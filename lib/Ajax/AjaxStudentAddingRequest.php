<?php

	if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']))
	{
		include_once("../../lib/Lib.php");

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$exam_id = $_POST['exam_id'];

		$student = new Student();
		$student->setFirstName($firstname);
		$student->setSurName($lastname);
		$student->setEmail($email);

		if (StudentDatabase::insertStudent($student)){

			$new_student_id = DatabaseConnector::getLastInsertedID();

			$record = new Record();
			$record->setStudentID($new_student_id);
			$record->setExamID($exam_id);

			if(RecordDatabase::insertRecord($record)) {
				//echo '<br/>Wpisano rekord';
			} else {
				//echo '<br/>Blad przy wpisywaniu rekordu';
			}

			$array = [
				0 => $new_student_id,
				1 => $firstname,
				2 => $lastname,
				3 => $email
			];

			header('Content-Type: application/json');
			echo json_encode($array);

		} else {
			header('Content-Type: application/json');
			echo json_encode(null);
		}

	}


?>