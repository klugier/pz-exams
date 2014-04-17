<?php
	// if POST display not empty and is expected string then use it, otherwise default to 'listview'
	//$_SESSION['display'] = ( ! empty($_POST['display']) && in_array($_POST['display'], array('listview', 'gridview'))) ? $_POST['display'] : 'listview';
	//$_SESSION['innerIStudentID'] = ( ! empty($_POST['innerIStudentID'])) ? $_POST['innerIStudentID'] : null;
	//$_SESSION['innerIStudentCode'] = ( ! empty($_POST['innerIStudentCode'])) ? $_POST['innerIStudentCode'] : null;
	if(session_id() == '') {
		session_start();
	}
	//$_SESSION['innerIExamID'] = ( ! empty($_POST['innerIExamID'])) ? $_POST['innerIExamID'] : NULL;
	//$q=$_GET["q"];
	//$exam = $_GET['exam'];
	if(isset($_GET['exam'])) { 
		$exam = $_GET['exam'];
		$_SESSION['innerIExamID'] = $exam;
		//header("refresh: 1; url=StudentExams.php?id="+$_GET['code']);
	} else { 
		echo "false"; 
	}
?>