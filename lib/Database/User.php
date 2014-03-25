<?php

class User
{
	public function __construct()
	{
		
	}
	
	// *****************************************************
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	// *****************************************************
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	public function setId($id)
	{
		$this->id = $id;		
	}
	// *****************************************************
	
	private $email;
	private $password;
	private $id;
}

?>
