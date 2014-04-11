<?php

include_once("../lib/Lib.php");

if(isset($_POST['exam_name']) && isset($_POST['exam_duration'])) {

    $exam = new Exam();
    $user = new User();    	
    $user->setID(unserialize($_SESSION['USER'])->getID());

	$exam->setName($_POST['exam_name']);
	$exam->setDuration($_POST['exam_duration']);
	$exam->setActivated(0);

	if (ExamDatabase::insertExam($user, $exam)) {
		//echo 'Wpisano egzamin';
	} else {
		//echo 'Blad przy wpisywaniu egzaminu';
	}

	addStudents();

	header('Content-Type: application/json');
	echo json_encode(true);

	}

function addStudents()
{

if(isset($_POST['students_emails']) && isset($_POST['firstnames']) && isset($_POST['lastnames'])) {
		
	$emails = $_POST['students_emails'];
	$f_names = $_POST['firstnames'];
	$l_names = $_POST['lastnames'];

	for ($i = 0; $i < count($emails); $i++) {
    	$student = new Student();
		$student->setEmail($emails[$i]);
		$student->setFirstName($f_names[$i]);
		$student->setSurName($l_names[$i]);

			if (StudentDatabase::insertStudent($student)) {
				//echo '<br/>Wpisano studenta';
			} else {
				//echo '<br/>Blad przy wpisywaniu studenta';
			}
		}
	}
}

?>