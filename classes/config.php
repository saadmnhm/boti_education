<?php
class Config {

	private $config = null;
	private $dbConfig = null;

	// Singletone Implementation
	public static function getInstance() {
		static $instance = null;
		if ($instance === null) {
			$instance = new self();
		}
		return $instance;
	}

	public static function get($config) {
		if (array_key_exists($config, self::getInstance()->config))
			return self::getInstance()->config[$config];
		self::getInstance()->loadDbConfig();
		if (array_key_exists($config, self::getInstance()->dbConfig))
			return self::getInstance()->dbConfig[$config];
		throw new Exception('Requested config "'.$config.'" not found!');
	}
	
	public static function set($config, $value) {
		if (array_key_exists($config, self::getInstance()->config))
			
			self::getInstance()->config[$config] = $value;
	}
	
	public static function has($config) {
		if (array_key_exists($config, self::getInstance()->config))
			return true;
		self::getInstance()->loadDbConfig();
		if (array_key_exists($config, self::getInstance()->dbConfig))
			return true;
		return false;
	}

	// Privates
	private function __construct() {
		$configFilePath = realpath(dirname(__FILE__).'/..').DIRECTORY_SEPARATOR.'config/config.php';
		if (!is_readable($configFilePath))
			throw new Exception('Could not load Config file');
		$this->config = require $configFilePath;
	}
	private static function loadDbConfig() {
		if (self::getInstance()->dbConfig === null) {
			self::getInstance()->dbConfig = array();
			$dbConfigs = DB::reader('SELECT `Alias`, `Value` FROM `configs`');
			foreach ($dbConfigs as $dbConfig) {
				self::getInstance()->dbConfig[$dbConfig['Alias']] = $dbConfig['Value'];
			}
		}
	}
}
