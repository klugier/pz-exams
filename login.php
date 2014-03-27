<?php
	
	include("lib/Lib.php");

	if(isset($_POST['email']) && isset($_POST['pass']))
	{
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$basicUser = new basicUser();
		$basicUser -> setEmail($email);
		$basicUser -> setPassword($pass);
		
		$usrDB = new UserDatabase();
		if($usrDB->checkEmail($basicUser))
		{
			if($usrDB->checkPassword($basicUser))
			{
				$_SESSION['USER'] = serialize($basicUser);
				header('Location: user_panel.php');
			} else {
				header('Location: index.php?err=2');
			}
		} else {
			header('Location: index.php?err=1');
		}
		
	} else {
		header('Location: index.php');
	}

?>
