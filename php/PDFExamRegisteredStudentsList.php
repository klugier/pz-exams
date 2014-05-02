<?php
	include_once("../lib/Lib.php");
	$id = $_GET['examID'];
	$setting = $_GET['setting'];
	$exam = ExamDatabase::getExam($id);
	
	class PDF extends TFPDF
	{

		function Table($header, $id, $setting)
		{
			if($setting == "full") {
				// Column widths
				$w = array(10, 50, 50, 50);
			
				$examDays = ExamUnitDatabase::getExamDays($id);
				$uniqeDays = array_unique($examDays);
				$weekDays = array(1 => "Poniedziałek", 2 => "Wtorek", 3 => "Środa", 4 => "Czwartek", 5 => "Piątek", 6 => "Sobota", 0 => "Niedziela");
			
				foreach ($uniqeDays as $dayCount => $day) {
					$this->Cell(160,10,$day." (".$weekDays[strftime('%w',strtotime($day))].")",0,0,'L');
					$this->Ln();
					// Header
					for ($i=0; $i < count($header); $i++)
						$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
					$this->Ln();
					// Data
					$examUnitIDList = ExamUnitDatabase::getExamUnitIDListDay($id, $day);
					foreach ($examUnitIDList as $number =>  $examUnitID) {
						$this->Cell($w[0], 6, number_format($number+1) . ".", 'LR', 0, 'C');
						$examunit = ExamUnitDatabase::getExamUnit($examUnitID);
						$this->Cell($w[1], 6, $examunit->getTimeFrom()." - ". $examunit->getTimeTo(), 'LR', 0, 'C');
						$record = RecordDatabase::getRecordFromUnit($examUnitID);
						if($record == NULL){
							$this->Cell($w[2],6,"",'LR',0,'C');
						} else {
							$student = StudentDatabase::getStudentByID($record->getStudentID());			
							if (($student->getFirstName() == NULL) || ($student->getFirstName() == "")){
								$this->Cell($w[2],6,$student->getEmail(),'LR',0,'C');
							} else {
								$this->Cell($w[2],6,$student->getFirstName() . " " . $student->getSurName(),'LR',0,'C');
							}
							$student = NULL;
						}
						$this->Cell($w[3],6,"",'LR',0,'C');
						$this->Ln();
					}
					// Closing line
					$this->Cell(array_sum($w), 0, '', 'T');
					if($dayCount != count($uniqeDays)-1) {
						$this->AddPage();
					}
				}
			}elseif($setting == "registered"){
				// Column widths
				$w = array(10, 50, 50, 50);
			
				$examDays = ExamUnitDatabase::getExamDays($id);
				$uniqeDays = array_unique($examDays);
				$weekDays = array(1 => "Poniedziałek", 2 => "Wtorek", 3 => "Środa", 4 => "Czwartek", 5 => "Piątek", 6 => "Sobota", 0 => "Niedziela");
			
				foreach ($uniqeDays as $dayCount => $day) {
					$examUnitIDListTest = ExamUnitDatabase::getExamUnitIDListDay($id, $day);
					$test = TRUE;
					foreach ($examUnitIDListTest as $examUnitIDTest) {
						$examunitTest = ExamUnitDatabase::getExamUnit($examUnitIDTest);
						if($examunitTest->getState() == "locked"){
							$test = FALSE;
						}
					}
					if($test){
						continue;
					}
					$this->Cell(160,10,$day." (".$weekDays[strftime('%w',strtotime($day))].")",0,0,'L');
					$this->Ln();
					// Header
					for ($i=0; $i < count($header); $i++)
						$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
					$this->Ln();
					// Data
					$examUnitIDList = ExamUnitDatabase::getExamUnitIDListDay($id, $day);
					foreach ($examUnitIDList as $number =>  $examUnitID) {
						$examunit = ExamUnitDatabase::getExamUnit($examUnitID);
						if($examunit->getState() == "unlocked"){
							$number = $number-1;
							continue;
						}
						$this->Cell($w[0], 6, number_format($number+1) . ".", 'LR', 0, 'C');
						$this->Cell($w[1], 6, $examunit->getTimeFrom()." - ". $examunit->getTimeTo(), 'LR', 0, 'C');
						$record = RecordDatabase::getRecordFromUnit($examUnitID);
						if($record == NULL){
							$this->Cell($w[2],6,"",'LR',0,'C');
						} else {
							$student = StudentDatabase::getStudentByID($record->getStudentID());			
							if (($student->getFirstName() == NULL) || ($student->getFirstName() == "")){
								$this->Cell($w[2],6,$student->getEmail(),'LR',0,'C');
							} else {
								$this->Cell($w[2],6,$student->getFirstName() . " " . $student->getSurName(),'LR',0,'C');
							}
							$student = NULL;
						}
						$this->Cell($w[3],6,"",'LR',0,'C');
						$this->Ln();
					}
					// Closing line
					$this->Cell(array_sum($w), 0, '', 'T');
					if($dayCount != count($uniqeDays)-1) {
						$this->AddPage();
					}
				}
			}else{
				$this->Cell(160, 10, "Error", 0, 0, 'C');
				$this->Ln();
			}
		}
	}
	$pdf = new PDF();
	// Column headings
	$header = array('Lp.', 'Termin', 'Student', 'Podpis');
	$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
	$pdf->SetFont('DejaVu', '', 14);
	$pdf->AddPage();
	$pdf->Cell(160, 10, $exam->getName(), 0, 0, 'C');
	$pdf->Ln();
	$pdf->Table($header, $id, $setting);
	$pdf->Output($exam->getName().".pdf","D");
	
	header('Location: ../ExamView.php?id='.$id); 
?>
