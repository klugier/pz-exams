<?php

class UserSetting
{
	public function __construct()
	{
		
	}
	
	// *****************************************************

	public function getID()
	{
		return $this->id;
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

	public function setUserID($userid)
	{
		return $this->userid = $userid ;
	}
	
	// *****************************************************
	
	private $id;
	private $userid;
	 
}

?>