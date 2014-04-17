<?php 
	include_once("lib/Lib.php");
	$title = "$appName - Strona Egzaminatora";
	include("html/Begin.php");
	include("html/UserPanel.php");
	
	$sql1 = "Select COUNT(ID) From Exams where UserID = '" . unserialize($_SESSION['USER'])->getID() . "'";
	$sql2 = "Select COUNT(ID) From Exams where UserID = '" . unserialize($_SESSION['USER'])->getID() . "' && Activated = 1";
	$sql3 = "Select COUNT(ID) From Exams where UserID = '" . unserialize($_SESSION['USER'])->getID() . "' && Activated = 0";

	$result = DatabaseConnector::getConnection()->query($sql1);
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
    $ExamsNum = $row[0];

    $result = DatabaseConnector::getConnection()->query($sql2);
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
    $ExamsAct = $row[0];

    $result = DatabaseConnector::getConnection()->query($sql3);
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
    $ExamsNact = $row[0];
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
		<td style="color:purple; font-weight:bold;">212</td>
	</tr>
	<tr>
		<td>Liczba zapisanych studentów</td>
		<td style="font-weight:bold;">0</td>
	</tr>
</table>
<br/>
<?php include ("html/End.php"); ?> 
