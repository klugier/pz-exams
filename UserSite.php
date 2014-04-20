<?php 
	include_once("lib/Lib.php");
	$title = "$appName - Strona Egzaminatora";
	include("html/Begin.php");
	include("html/UserPanel.php");
	
	$sql = "Select COUNT(ID) From Exams where UserID = '" . unserialize($_SESSION['USER'])->getID() . "'";

	$result = DatabaseConnector::getConnection()->query($sql);
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
    	$ExamsNum = $row[0];

    	$ExamsAct = ExamUnitDatabase::countOpenExams(unserialize($_SESSION['USER'])->getID(),1);
    	$ExamsNact = ExamUnitDatabase::countOpenExams(unserialize($_SESSION['USER'])->getID(),0);

	$StudentsN = RecordDatabase::countUserStudents(unserialize($_SESSION['USER'])->getID());
    	$StudentsSignedN = RecordDatabase::countUserStudentsSingedToExams(unserialize($_SESSION['USER'])->getID()); 
?>
<table style="font-size:17px; width:350px; " class="table">
	<tr class="success">
		<th colspan="2" style="font-size:21px;" >Statystyki</th>
	<tr>
	<tr>
		<td>Ilość egzaminów</td>	
		<td style="color:green; font-weight:bold;"><?php echo $ExamsNum; ?></td>
	</tr>
	<tr>
		<td>Ilość aktywnych egzaminów</td>
		<td style="color:blue; font-weight:bold;"><?php echo $ExamsAct; ?></td>
	</tr>
	<tr>
		<td>Ilość nieaktywnych egzaminów</td>
		<td style="color:red;font-weight:bold;"><?php echo $ExamsNact; ?></td>
	</tr>
	<tr>
		<td>Liczba wprowadzonych studentów</td>
		<td style="color:purple; font-weight:bold;"><?php echo $StudentsN; ?></td>
	</tr>
	<tr>
		<td>Liczba zapisanych studentów</td>
		<td style="font-weight:bold;"><?php echo $StudentsSignedN; ?></td>
	</tr>
</table>
<br/>
<?php include ("html/End.php"); ?> 
