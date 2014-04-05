<?php

class Exam
{
	public function __construct()
	{
		
	}
	
	// *****************************************************

	public function getID()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getDuration ()
	{
		return $this->duration;
	}
    
	public function getUserID ()
	{
		return $this->userid;
	}
	
	public function getActivated()
	{
		return $this->activated;
	}
	
	// *****************************************************
	
	public function setID($id)
	{
		$this->id = $id;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setDuration($durat)
	{
		$this->duration = $durat;
	}

	public function setUserID($userid)
	{
		return $this->userid = $userid ;
	}
	
	public function setActivated($activate)
	{
		return $this->activated = $activate;
	}
	
	// *****************************************************
	
	private $id;
	private $name; 
	private $duration;
	private $userid;
	private $activated;
	 
}

?>