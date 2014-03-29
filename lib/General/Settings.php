<?php

final class Settings
{
	public static function save()
	{
		
	}
	
	public static function getDebug()
	{
		return self::getInstance()->debug;
	}
	
	public static function setDebug($debug)
	{
		self::getInstance()->debug = $debug;
	}
	
	private static function getInstance()
	{
		if (self::$instance == false) {
			self::$instance = new Settings(dirname(__FILE__) . "/../../cfg/Settings.xml");
		}
		return self::$instance;
	}
	
	private function __construct($cfgPath)
	{
		if (!file_exists($cfgPath)) {
			echo "Nie udało się odnaleźść pliku \"" . $cfgPath . "\".\n";
			return;
		}
		
		$xml = simplexml_load_file($cfgPath);
		$this->debug = $xml->Debug;
	}
	
	private $debug;
	
	private static $instance = false;
}

?>
