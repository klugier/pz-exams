<?php

class Record
{
	public function __construct()
	{
		
	}
	
	// *****************************************************

	public function getID()
	{
		return $this->id;
	}
    
    public function getStudentID ()
	{
		return $this->studentid;
	}
	    
    public function getExamID ()
	{
		return $this->examid;
	}
	
    public function getExamUnitID ()
	{
		return $this->examunitid;
	}
    
    public function getCode ()
	{
		return $this->code;
	}
    
	// *****************************************************
	
	public function setID($id)
	{
		$this->id = $id;
	}

	public function setStudentID($userid)
	{
		return $this->studentid = $studentid ;
	}
	
    public function setExamID($id)
	{
		$this->examid = $examid;
	}

	public function setExamUnitID($userid)
	{
		return $this->examunitid = $examunitid ;
	}
    
    public function setCode($code)
	{
		$this->code = $code;
	}

	// *****************************************************
	
	private $id;
	private $studentid; 
    private $examid;
    private $examunitid;
    private $code;
	 
}

?>