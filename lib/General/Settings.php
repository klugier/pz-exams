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
	
	public static function getDomains()
	{
		return self::getInstance()->domains;
	}
	
	public static function getPath()
	{
		return dirname(__FILE__) . "/../../cfg/Settings.xml";
	}
	
	public static function getAdress()
	{
		return self::getInstance()->adress;
	}
	
	public static function setDebug($debug)
	{
		self::getInstance()->debug = $debug;
	}
	
	public static function setDomains($domains)
	{
		self::getInstance()->domains = $domains;
	}
	
	public static function setAdress()
	{
		self::getInstance()->adress;
	}
	
	private static function getInstance()
	{
		$cfgPath = dirname(__FILE__) . "/../../cfg/Settings.xml";
		
		if (self::$instance == false) {
			self::$instance = new Settings($cfgPath);
		}
		return self::$instance;
	}
	
	private function __construct($cfgPath)
	{
		$this->debug   = 0;
		$this->domains = null;
		$this->adress  = "";
		
		$this->__load($cfgPath);
	}
	
	private function __load($cfgPath)
	{
		if (!file_exists($cfgPath)) {
			echo "Nie udało się odnaleźść pliku \"" . $cfgPath . "\".\n";
			return;
		}
		
		$dom = new DOMDocument();
		$dom->load($cfgPath);
		$xml = simplexml_load_file($cfgPath);
		
		if ($dom->getElementsByTagName("Debug")->length > 0) {
			$this->debug = $xml->Debug;
		}
		
		if ($dom->getElementsByTagName("Domains")->length > 0) {
			$i = 0;
			foreach ($xml->Domains->Domain as $domain) {
				$this->domains[$i] = $domain;
				$i++;
			}
		}
		
		if ($dom->getElementsByTagName("Adress")->length > 0) {
			$this->adress = $xml->Adress;
		}
	}
	
	private $debug;
	private $domains;
	private $address;
	
	private static $instance = false;
}

?>
