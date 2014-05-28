<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - List studentów";
	$scripts = array("js/Lib/bootbox.min.js", "js/Lib/spin.min.js", "js/Lib/ladda.min.js");
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
	
		ob_end_flush();
		return;
	}
	
	include("html/AdminPanel.php");

	echo '<span style="float: right"><a class="btn btn-primary btn-sm pull-right" href="controler/DeleateExpiredExams.php" title="Usuń przedawnione egzaminy."><i class="glyphicon glyphicon-trash"></i> <b>Usuń przedawnione egzaminy</b></a></span>';
	
	$examList = ExamDatabase::getAllExams();
	
	if (!is_array($examList)) {
		$displayTable = ' style="display: none;"';
	} else {
		$displayInfo = ' display: none;"';
	}
	
	//echo '<pre>'; print_r($examList); echo '</pre>';
	
	echo '<div style="margin-top: 5%;"><h3 id="empty_list" style="text-align: center; margin-bottom: 4%;' . $displayInfo . '>Lista studentów jest obecnie pusta</h3>
		<table class="table" id="students"' . $displayTable . '>
		<thead>
			<tr>
				<th style="text-align: center;">Lp.</th>
				<th style="text-align: center;">ID</th>
				<th>Nazwa</th>
				<th>Czas</th>
				<th>Egzaminator</th>
				<th style="text-align: center;">Aktywny</th>
				<th style="text-align: center;">Przedawniony</th>
			</tr>
		</thead>
		<tbody>';
	
	if (is_array($examList)) {
		foreach ($examList as $number => $exam) {
			$examDays = ExamUnitDatabase::getExamDays($exam->getID());
			echo '<tr id="' . $exam->getID() . '">';
			echo '<td id="number" style="text-align: center;">' . ($number+1) .  '.</td>';
			echo '<td id="examID" style="text-align: center;">' . $exam->getID() . '</td>';
			echo '<td id="name">' . $exam->getName() . '</td>';
			echo '<td style="vertical-align:middle;" id="time">';
			$j = 0;

			if($examDays!=null){
				$uniqeDays = array_unique($examDays);
			
				$startDay = null;
				foreach ($uniqeDays as $day){
					if($j == 0){
						$startDay = $day;
						echo $day;
					}elseif($j == count($uniqeDays)-1){
						if(date("Y",strtotime($day)) != date("Y",strtotime($startDay))){
							echo " do ".date("Y-m-d",strtotime($day));
						}elseif(date("m",strtotime($day)) != date("m",strtotime($startDay))){
							echo " do ".date("m-d",strtotime($day));
						}elseif(date("d",strtotime($day)) != date("d",strtotime($startDay))){
							echo "/".date("d",strtotime($day));
						}
					}
					$j++;
				}
			}
			echo '</td>';
			$examinator = UserDatabase::getUser($exam->getUserID());
			echo '<td id="examinator">' . $examinator->getFirstName() . " " . $examinator->getSurname() . '</td>';
			echo '<td style="text-align: center;" id="active">';
			if($exam->getActivated() == TRUE){
				echo "<b style=\"color: #156815;\">Tak</b>";
			}else{
				echo "<b style=\"color: #801313;\">Nie</b>";
			} 
			echo '</td>';
			echo '<td style="text-align: center;">';
			if(date_create($examDays[count($examDays)-1]) < new DateTime("now")){
				echo "<b style=\"color: #156815;\">Tak</b>";
			}else{
				echo "<b style=\"color: #801313;\">Nie</b>";
			}
			echo '</td>';
			echo '</tr>';
		}
	}
	
	echo '</tbody></table></div>';
	
	include("html/End.php");
	
	ob_end_flush();
?> 