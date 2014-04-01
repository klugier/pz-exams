<?php
	
	include("lib/Lib.php");

	if(isset($_POST['email']) && isset($_POST['pass']))
	{
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$basicUser = new basicUser();
		$basicUser->setEmail($email);
		$basicUser->setPassword($pass);
		
		
		if(UserDatabase::checkEmail($basicUser))
		{
			if(UserDatabase::checkPassword($basicUser))
			{
				$_SESSION['USER'] = serialize($basicUser);
				header('Location: UserSite.php');
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
