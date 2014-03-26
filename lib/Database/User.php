<?php

class BasicUser
{
	public function __construct()
	{
		
	}
	
	public function getID()
	{
		return $this->id;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	

	public function setID($id)
	{
		$this->id = $id;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	
	private $id;
	private $email;
	private $password;
}

class User extends BasicUser
{
	public function __construct()
	{
		
	}
	
	
	public function getName()
	{
		return $this->name;
	}
	
	
	public function setName($name)
	{
		return $this->name = $name ;
	}
	
	
	private $id;
	private $email;
	private $password;
	private $name; 
}

?>