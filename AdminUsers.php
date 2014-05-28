<?php
	ob_start();
	
	include_once("lib/Lib.php");
	$title = "$appName - List studentów";
	$scripts = array("js/Lib/bootbox.min.js", "js/Lib/spin.min.js", "js/Lib/ladda.min.js", "js/UserList.js");
	include("html/Begin.php");
	
	if (!isset($_SESSION['USER']) || $_SESSION['USER'] == "") {
		echo "<div class=\"alert alert-danger\"><b>Strona widoczna jedynie dla zalogowanych użytkowników.</b> Za 3 sekundy zostaniesz przeniesiony na stronę główną.</div>";
		header("refresh: 3; url=index.php");
		include("html/End.php");
		
		ob_end_flush();
		return;
	}
	
	include("html/AdminPanel.php");
	
	echo "<h2>Lista użytkowników</h2>";
	echo "<p>W tym miejscu znajduje się lista wszystkich użytkowników.</p>";
	echo "<hr />";

	$userList = UserDatabase::getAllUsers();

	if (!is_array($userList)) {
		$displayTable = ' style="display: none;"';
	} else {
		$displayInfo = ' display: none;"';
	}

	//echo '<pre>'; print_r($userList); echo '</pre>';

	echo '<div style="margin-top: 5%;"><h3 id="empty_list" style="text-align: center; margin-bottom: 4%;' . $displayInfo . '>Lista studentów jest obecnie pusta</h3>
		<table class="table" id="students"' . $displayTable . '>
		<thead>
			<tr>
				<th style="text-align: center;">Lp.</th>
				<th style="text-align: center;">ID</th>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>E-mail</th>
				<th>Ranga</th>
				<th style="text-align: center;">Operacje</th>
			</tr>
		</thead>
		<tbody>';

	if (is_array($userList)) {
		foreach ($userList as $number => $user) {
			echo '<tr id=row-id-' . $user->getID() . '>';
			echo '<td id="row-lp-'. ($number+1) . '" style="text-align: center;">' . ($number+1) .  '.</td>';
			echo '<td id="userID" style="text-align: center;">' . $user->getID() . '</td>';
			
			$fName = "-";
			$lName = "-";

			if ($user->getFirstName() != "") {
				$fName = $user->getFirstName();
			}

			if ($user->getSurname() != "") {
				$lName = $user->getSurname();
			}

			echo '<td id="firstname">' . $fName . '</td>';
			echo '<td id="lastname">' . $lName . '</td>';
			echo '<td id="row-email-id-' . $user->getID()  . '">' . $user->getEmail() . '</td>';
			echo '<td id="rank">';
			if($user->getRight() == "examiner"){
				echo "Egzaminator";
			}else{
				echo "Admin";
			} 
			echo '</td>';
			$id = $user->getID();
			echo "<td style=\"text-align: center;\" id=\"data\">" . 
			"<a class=\"btn btn-primary btn-sm\" href=\"AdminUserEdit.php?UserToEdit=" . $id . "\" style=\"margin-right: 1px;\" title=\"Edytuj Użytkownika\"><i class=\"glyphicon glyphicon-pencil\" data-toggle=\"tooltip\" data-placement=\"top\" ></i></a>" .
			"<a class=\"btn btn-primary btn-sm\" href=\"controler\ChangeRank.php?UserToRank=" . $id . "\" style=\"margin-right: 1px;\" title=\"Zmień rangę\"><i class=\"glyphicon glyphicon-star\" ></i></a>" .
			"<a class=\"btn btn-primary btn-sm\" id=\"row-delete-id-" . $id . "\" style=\"cursor: pointer;\" title=\"Usuń użytkownika\"><i class=\"glyphicon glyphicon-trash\" ></i></a>";
			echo "</td>";
			echo '</tr>';
		}
	}

	echo '</tbody></table></div>';

	include("html/End.php");
	
	ob_end_flush();
?> 