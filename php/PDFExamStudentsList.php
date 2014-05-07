<?php
		include_once("../lib/Lib.php");
		$id   = $_GET['examID'];
		$exam = ExamDatabase::getExam($id);
	
	// extend TCPF with custom functions
	class MYPDF extends TCPDF {
	
		// Colored table
		public function Table($header,$id) {
			// Colors, line width and bold font
			$this->SetFillColor(0, 0, 0);
			$this->SetTextColor(255);
			$this->SetLineWidth(0.3);
			$this->SetFont('', 'B');
			// Header
			$w = array(10, 40, 40, 70);
			$num_headers = count($header);
			for($i = 0; $i < $num_headers; ++$i) {
				$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
			}
			$this->Ln();
			// Color and font restoration
			$this->SetFillColor(224, 235, 255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Data
			$studentIDList = RecordDatabase::getStudentIDList($id);
			$studentList = null;
			if (is_array($studentIDList)) {
				$i = 0;
				foreach ($studentIDList as $studentID) {
					$studentList[$i++] = StudentDatabase::getStudentByID($studentID);
				}
			}
			$fill = 0;
			foreach($studentList as $number => $student) {
				$this->Cell($w[0], 6, number_format($number+1), 'LR', 0, 'C', $fill);
				$this->Cell($w[1], 6, $student->getFirstName(), 'LR', 0, 'C', $fill);
				$this->Cell($w[2], 6, $student->getSurname()  , 'LR', 0, 'C', $fill);
				$this->Cell($w[3], 6, $student->getEmail()    , 'LR', 0, 'C', $fill);
				$this->Ln();
				$fill=!$fill;
			}
			$this->Cell(array_sum($w), 0, '', 'T');
		}
	}
	
	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	
	// set default header data
	$user = UserDatabase::getUser($exam->getUserID());
	$name = $exam->getName();
	$examiner  = "Egzaminator: ".$user->getFirstName()." ".$user->getSurname();
	$pdf->SetHeaderData('logo_button.png', 50, $name, $examiner);
	
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set some language-dependent strings (optional)
	global $l;
	$l = Array();
	$l['a_meta_charset'] = 'UTF-8';
	$l['a_meta_dir'] = 'ltr';
	$l['a_meta_language'] = 'pl';-
	$l['w_page'] = 'strona';
	$pdf->setLanguageArray($l);
	
	// ---------------------------------------------------------
	
	// set font
	$pdf->SetFont('dejavusanscondensed', '', 12);
	
	// add a page
	$pdf->AddPage();
	
	// column titles
	$header = array('Lp.', 'Imię', 'Nazwisko', 'E-mail');
	
	// print table
	$pdf->Table($header, $id);
	
	// ---------------------------------------------------------
	
	// close and output PDF document

	$pdf->Output($exam->getName().".pdf","D");
	
	//============================================================+
	// END OF FILE
	//============================================================+
	
	header('Location: ../ExamStudentsList.php?examID='.$id); 
?>
