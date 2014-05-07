<?php
	include_once("../Lib.php");

	header("content-type:application/json");
	
	function handlingError($msg) {
		echo json_encode(array("status" => "failed", "errorMsg" => $msg, "changes" => ""));
	}
	
	function handlingSuccess1() {
		echo json_encode(array("status" => "success", "errorMsg" => ""));
	}
	function handlingSuccess2() {
		echo json_encode(array("status" => "success", "errorMsg" => ""));
	}	


	if (!isset($_SESSION["USER"])) {
		$errorMsg = "Błąd krytyczny: użytkownik jest niezalogowany.";
		handlingError($errorMsg);
		return;
	} else {
		$user = unserialize($_SESSION["USER"]);
	}

	if(isset($_POST['examID']) && isset($_POST['mails']) && $_POST['mails'] == 1){
		$studentsID = RecordDatabase::getStudentIDList($_POST['examID']);
		$examName = ExamDatabase::getExam($_POST['examID'])->getName();
		if(sizeof($studentsID) >= 1){
			foreach($studentsID as $studentID ){
				$student = StudentDatabase::getStudentByID($studentID);
				if( $student -> getCode() == NULL || $student -> getCode() == 0 ){
					$code = md5(microtime());
					while(StudentDatabase::addStudentCode($studentID, $code) != true){
						$code = md5(microtime());
					}	
					$student = StudentDatabase::getStudentByID($studentID);
				}				
				
				$email = $student -> getEmail();
				$code = $student -> getCode();
			
				$studentCodeUrl = "http://" . Settings::getAdress() . "/StudentExams.php?code=" . $code;
				$messageBody = 
					"Witaj!<br/><br/>" .
					"Zostałeś dodany do egzaminu ustnego z: <b>". $examName ."</b> na serwisie PZ-EXAMS.<br/><br/>" .
					"By dokonać zapisu kliknij w poniższy link i wybierz odpowiadający Ci termin z listy. <br/>".
					"<a href=\"" . $studentCodeUrl . "\">" . $studentCodeUrl . "</a><br/><br/>" .
					"______________________________<br/>" .
					"Pozdrawiamy - zespół PZ-Exams<br/>";
			
				mailer($email,'cos nieistiotnego',"PZ-Exams", "Nowy egzamin", $messageBody, true);				
			}
		}
		handlingSuccess1();
		return;
	}
	else if(isset($_POST['examID']) && isset($_POST['studentID'])){

		$exam = ExamDatabase::getExam($_POST['examID']);
		$student = StudentDatabase::getStudentByID($_POST['studentID']);

		if($student -> getCode() == NULL){
			$code = md5(microtime());
			while(StudentDatabase::addStudentCode($student->getID(), $code) != true){
						$code = md5(microtime());
			}	
			$student = StudentDatabase::getStudentByID($student->getID());
		}

		$examName = $exam -> getName();					
		$email = $student -> getEmail();
		$code = $student -> getCode();
		$mailson = Settings::getEmailAdress();


		if($student->getFirstName() == NULL){
			$imie = "";
		} else {
			$imie = " ".$student -> getFirstName();	
		}
		$mailson = Settings::getEmailAdress();

		$studentCodeUrl = "http://" . Settings::getAdress() . "/StudentExams.php?code=" . $code;

		$messageBody = 	"Witaj".$imie."!<br/><br/>" .
						"Zostałeś dodany do egzaminu ustnego z: <b>". $examName ."</b> na serwisie PZ-EXAMS.<br/><br/>" .
						"By dokonać zapisu kliknij w poniższy link i wybierz odpowiadający Ci termin z listy. <br/>".
						"<a href=\"" . $studentCodeUrl . "\">" . $studentCodeUrl . "</a><br/><br/>" .
						"______________________________<br/>" .
						"Pozdrawiamy - zespół PZ-Exams<br/>";
				
		mailer($email,'cos nieistotnego',"PZ-Exams", "Nowy egzamin", $messageBody, true);	
		$msg = $mailson;
		handlingError($msg);
		return;
	} else {
		$msg = "Nie podano podstawowych parametrow";
		handlingError($msg);
		return;
	}



?>
