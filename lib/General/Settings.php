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
	
	public static function getEmailAdress()
	{
		return self::getInstance()->emailAdress;
	}
	
	public static function getEmailPassword()
	{
		return self::getInstance()->emailPassword;
	}
	
	public static function getEmailHost()
	{
		return self::getInstance()->emailHost;
	}
	
	public static function getEmailPort()
	{
		return self::getInstance()->emailPort;
	}
	
	public static function setDebug($debug)
	{
		self::getInstance()->debug = $debug;
	}
	
	public static function setDomains($domains)
	{
		self::getInstance()->domains = $domains;
	}
	
	public static function setAdress($adress)
	{
		self::getInstance()->adress = $adress;
	}
	
	public static function setEmailAdress($emailAdress)
	{
		self::getInstance()->emailAdress = $emailAdress;
	}
	
	public static function setEmailPassword($emailPassword)
	{
		self::getInstance()->emailPassword = $emailPassword;
	}
	
	public static function setEmailHost($emailHost)
	{
		self::getInstance()->emailHost = $emailHost;
	}
	
	public static function setEmailPort($emailPort)
	{
		self::getInstance()->emailPort = $emailPort;
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
		$this->debug         = 0;
		$this->domains       = null;
		$this->adress        = "";
		$this->emailAdress   = "";
		$this->emailPassword = "";
		
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
		
		if ($dom->getElementsByTagName("Email")->length > 0) {
			$this->emailAdress = $xml->Email->Adress;
			$this->emailPassword = $xml->Email->Password;
			$this->emailHost = $xml->Email->Host;
			$this->emailPort = (int)$xml->Email->Port;
		}
	}
	
	private $debug;
	private $domains;
	private $address;
	private $emailAdress;
	private $emailPassword;
	private $emailHost;
	private $emailPort;
	
	private static $instance = false;
}

?>
