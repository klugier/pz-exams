<?php
	
	include_once("../lib/Lib.php");
	$id = "1";
		$exam = ExamDatabase::getExam($id);
	
		class PDF extends TFPDF
		{

			function Table($header, $id)
			{
				// Column widths
				$w = array(10, 40, 40, 70);
				// Header
				for($i=0;$i<count($header);$i++)
					$this->Cell($w[$i],7,$header[$i],1,0,'C');
				$this->Ln();
				// Data
				$studentIDList = RecordDatabase::getStudentIDList($id);
				$studentList = null;
				if (is_array($studentIDList)) {
					$i = 0;
					foreach ($studentIDList as $studentID) {
						$studentList[$i++] = StudentDatabase::getStudentByID($studentID);
					}
				}
				foreach ($studentList as $number => $student) {
					$this->Cell($w[0],6,number_format($number+1),'LR',0,'C');
					$this->Cell($w[1],6,$student->getFirstName(),'LR',0,'C');
					$this->Cell($w[2],6,$student->getSurname() ,'LR',0,'C');
					$this->Cell($w[3],6,$student->getEmail(),'LR',0,'C');
					$this->Ln();
				}
				// Closing line
				$this->Cell(array_sum($w),0,'','T');
			}
	}

		
		$pdf = new PDF();
		// Column headings
		$header = array('Lp.', 'Imię', 'Nazwisko', 'E-mail');
		$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
		$pdf->SetFont('DejaVu','',14);
		$pdf->AddPage();
		$pdf->Cell(160,10,$exam->getName(),0,0,'C');
		$pdf->Ln();
		$pdf->Table($header,$id);
		$pdf->Output($exam->getName().".pdf","I");
?>
