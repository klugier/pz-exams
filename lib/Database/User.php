<?php

class User
{
	public function __construct()
	{
		$this->name = "unknown" ; 
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
	
	public function getName()
	{
		return $this->name;
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

	public function setName($name)
	{
		return $this->name = $name ;
	}
	
	// *****************************************************
	
	private $email;
	private $password;
	private $name ; 
}

?>