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
	
	public static function setDebug($debug)
	{
		self::getInstance()->debug = $debug;
	}
	
	public static function setDomains($domains)
	{
		self::getInstance()->domains = $domains;
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
				$this->domain[$i] = $domain;
			}
		}
	}
	
	private $debug;
	private $domains;
	
	private static $instance = false;
}

?>
