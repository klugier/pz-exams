<?php

final class DatabaseConnector
{
	public static function getConnection() 
	{
		return self::getInstance()->connection; 
	}
	
	public static function getLastError()
	{
		// return self::getInstance()->connection->error;
	}
	
	private static function getInstance()
	{
		if (self::$instance == false) {
			self::$instance = new DatabaseConnector("cfg/Database.cfg");
			self::$instance->connect();
		}
		return self::$instance;
	}
	
	/*
	 * Wszystkie dane potrzebne do połączenia z bazą danych będzeimy wczytywać z pliku.
	 * Jest to uzasadanione rozwiązanie ponieważ, każdy u siebie lokalnie będzie mógł sobie zdefiniować
	 * ten plik.
	 */
	private function __construct($cfgPath) 
	{
		$lines = file($cfgPath);
		foreach ($lines as $lineNumber => $line) {
			$line = rtrim($line);
			
			switch ($lineNumber) {
				case 0:
					$this->server = $line;
					break;
					
				case 1:
					$this->user = $line;
					break;
					
				case 2:
					$this->password = $line;
					break;
					
				case 3:
					$this->database = $line;
					break;
			}
		}
	}
	
	private function __destruct()
	{
		$connection->close();
	}
	
	private function connect()
	{
		$this->connection = new mysqli($this->server, $this->user, $this->password, $this->database);
		if ($this->connection->connect_errno) {
			echo "<b>Nie udało się połączyć z bazą danych MySQL: (" . $this->connection->connect_errno . ")</b>";
		}
	}
	
	private function toString()
	{
		$str = "Server:   " . $this->server   . "<br \>" .
		       "User:     " . $this->user     . "<br \>" .
			   "Password: " . $this->password . "<br \>" .
			   "Database: " . $this->database . "<br \>"
			   ;
		
		return $str;
	}
	
	private $connection;
	private $server; 
	private $user; 
	private $password; 
	private $database;
	
	private static $instance = false;
}

?>
