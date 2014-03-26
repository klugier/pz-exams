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
		return $this->durat;
	}
    
    public function getUserID ()
	{
		return $this->userid;
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
		$this->durat = $durat;
	}

	public function setUserID($userid)
	{
		return $this->userid = $userid ;
	}
	
	// *****************************************************
	
	private $id;
	private $name; 
    private $durat;
    private $userid;
	 
}

?>