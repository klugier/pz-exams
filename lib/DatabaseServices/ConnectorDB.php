<?php

class ConnectorDB  
{ 
	private $mysqliConnection ;
	private $localhost ; 
	private $user ; 
	private $password ; 
	private $database ; 
	function __construct( $l , $u , $p , $d  ) 
	{ 
		$this->localhost = $l;
		$this->user =  $u; 
		$this->password = $p ;   
		$this->database = $d ;
	} 
	public function connectDB (  )
	{ 
		$this->mysqliConnection = new mysqli($this->localhost, $this->user, $this->password, $this->database);
		if ( $this->mysqliConnection->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		} else {
			echo $this->mysqliConnection->host_info . "\n";
		}
	} 
	public function getConnection ( ) 
	{ 
		return $this->mysqliConnection  ; 
	} 
} 


	// testing code it works !!!   
	// change connection for your local mysql settings 
	//$db = new ConnectorDB ( "localhost" , "root" , "password" , "bazaZbigniew") ;
	//$db -> connectDB ( ) ; 
	
	// example querry for our database 
	
	/*if ($result = $db->getConnection()->query("SELECT * FROM Users LIMIT 10")) {
			printf("Select returned %d rows.\n", $result->num_rows);
			$result->close();
	}*/

	
?>