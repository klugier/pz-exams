<?php
	include_once("lib/Lib.php");

	$title = "$appName";
	include("html/Begin.php");
?>

<?php 
	if (isset($_SESSION['formSuccessCode'])) {
		echo '<div class="alert alert-success">' ;
		echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
		echo '<strong>Użytownik zarejestrowany poprawnie. E-mail z linkiem aktywacyjnym został wysłany. </strong>'; 			
		echo '</div>' ; 
		unset($_SESSION['formSuccessCode']);
	}
	
	if (isset($_GET['error'])) {
		echo '<div class="alert alert-danger">' ;
		echo '<a href="#" class="close" data-dismiss="alert"> &times; </a>' ; 
		
		if($_GET['error'] == '1') {
			echo '<strong>Nie ma takiego użytkownika w bazie!</strong>';
		}
		elseif ($_GET['error'] == '2') {
			echo '<strong>Podane hasło jest niepoprawne!</strong>';
		}
		echo '</div>' ;
	}
?> 

<h3>Witaj na platformie</h3>

<p style="text-align: justify; margin-top: 30px;">
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<hr>

<p style="text-align: justify;">
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<?php include("html/End.php"); ?>
