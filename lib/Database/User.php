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
	
	private $id;
	private $email;
	private $password;
	private $activated;
}

class User extends BasicUser
{
	public function __construct()
	{
		
	}
	
	public function toString() 
	{ 
		echo "Object User Info <br /> "; 
		echo "Id: "       . $this->id       . "<br /> " ;
		echo "Email: "    . $this->getEmail()    . "<br /> " ; 
		echo "Password: " . $this->getPassword() . "<br /> " ;
		echo "Name: "     . $this->getName()     . "<br /> " ;  
		echo "Surname: "  . $this->getSurname()  . "<br /> " ;
		echo "Gender: "   . $this->getGender()   . "<br /> " ;
	} 
	
	public function getName()
	{
		return $this->name;
	}
	
	
	public function setName($name)
	{
		$this->name = $name ;
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
	private $id;
	private $email;
	private $password;
	private $name; 
	private $surname ;
	private $gender ; 
}

?>