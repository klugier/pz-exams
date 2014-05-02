<?php
	include_once("../lib/Lib.php");
	$id   = $_GET['examID'];
	$exam = ExamDatabase::getExam($id);
	
	class PDF extends TFPDF
	{
		function Table($header, $id)
		{
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
	$pdf->Table($header, $id);
	$pdf->Output($exam->getName().".pdf","D");
	
	header('Location: ../ExamView.php?id='.$id); 
?>
