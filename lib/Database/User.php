<?php

class BasicUser
{
	public function __construct()
	{
		$this->activated = true;
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
	
	public function getActivated()
	{
		return $this->activated;
	}

	public function getActivationCode()
	{
		return $this->activation_code;
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
	
	public function setActivated($activated)
	{
		$this->activated = $activated;
	}

	public function setActivationcode($activation_code)
	{
		$this->activation_code = $activation_code;
	}
	
	protected $id;
	protected $email;
	protected $password;
	protected $activated;
	protected $activation_code;
}

class User extends BasicUser
{
	public function __construct()
	{
		
	}
	
	public function toString() 
	{ 
		echo "Object User Info <br /> "; 
		echo "Id: "       . $this->id        . "<br /> " ;
		echo "Email: "    . $this->email     . "<br /> " ; 
		echo "Password: " . $this->password  . "<br /> " ;
		echo "Name: "     . $this->firstName . "<br /> " ;  
		echo "Surname: "  . $this->surname   . "<br /> " ;
		echo "Gender: "   . $this->gender    . "<br /> " ;
	} 
	
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}
	
	public function getSurname()
	{
		return $this->surname;
	}
	
	
	public function setSurname($surname)
	{
		 $this->surname = $surname ;
	}
	
	public function getGender()
	{
		return $this->gender;
	}
	
	
	public function setGender($gender)
	{
		 $this->gender = $gender;
	}
	
	/*public function getVisibility ()
	{
		return $this->$visibility ;
	}
	
	
	public function setVisibility (  $visibility  )  
	{
		 $this->visibility  = $visibility  ;
	}
	//
	
	public function getRights ()
	{
		return $this->$rights ;
	}
	
	
	public function setRights (  $rights  )  
	{
		 $this->rights  = $rights ;
	}
	
	private $visibility; */
	private $firstName; 
	private $surname ;
	private $gender ; 
}

?>