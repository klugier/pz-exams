<?php
	
	//include("TestBegin.php");
	include_once('../lib/Utility/PDF/tfpdf.php');
	
	// Optionally define the filesystem path to your system fonts
	// otherwise tFPDF will use [path to tFPDF]/font/unifont/ directory
	// define("_SYSTEM_TTFONTS", "C:/Windows/Fonts/");
	
	
	$pdf = new tFPDF();
	$pdf->AddPage();
	//echo "1<br>";
	// Add a Unicode font (uses UTF-8)
	$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
	$pdf->SetFont('DejaVu','',14);
	//echo "2<br>";
	// Load a UTF-8 string from a file and print it
	$txt = file_get_contents('HelloWorld.txt');
	$pdf->Write(8,$txt);
	//echo "3<br>";
	// Select a standard font (uses windows-1252)
	$pdf->SetFont('Arial','',14);
	$pdf->Ln(10);
	$pdf->Write(5,'Theąęówśćżź ĄĘÓŻŹĆŚ file size of this PDF is only 12 KB.');
	//echo "4<br>";
	$pdf->Output();
	//echo "5<br>";
	//include("TestEnd.php");		
?>
