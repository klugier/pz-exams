<?php

class Student
{
	public function __construct()
	{
		
	}
	
	// *****************************************************

	public function getID()
	{
		return $this->id;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	// *****************************************************
	
	public function setID($id)
	{
		$this->id = $id;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}

	
	// *****************************************************
	
	private $id;
	private $email;
	 
}

?>