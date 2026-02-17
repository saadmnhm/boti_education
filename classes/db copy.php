<?php

class DB
{
	private $pdo = null;

	private $config = null;

	// Singletone Implementation
	public static function getInstance()
	{

		static $instance = null;

		if ($instance === null) {

			$instance = new self();
		}

		return $instance;
	}


	// Returns PDO Object
	public static function getPDO()
	{

		return self::getInstance()->pdo;
	}


	// Transaction
	public static function begin()
	{

		return self::getPDO()->query('BEGIN');
	}

	public static function commit()
	{

		return self::getPDO()->query('COMMIT');
	}

	public static function rollback()
	{

		return self::getPDO()->query('ROLLBACK');
	}



	// Database Access Functions

	public static function reader($query, $params = NULL)
	{

		if (!$params)

			$rep = self::getPDO()->query($query);

		else {

			$rep = self::getPDO()->prepare($query);

			$rep->execute($params);
		}

		$result = array();

		while ($data = $rep->fetch()) {

			$result[] = $data;
		}

		return $result;
	}


	public static function readerFetch($query, $params = NULL)
	{


		if (!$params)
			$rep = self::getPDO()->query($query);
		else {
			$rep = self::getPDO()->prepare($query);
			$rep->execute($params);
		}

		return $rep;
	}

	public static function noQuery($query, $params = NULL)
	{

		if (!$params)

			$rep = self::getPDO()->query($query);

		else {

			$rep = self::getPDO()->prepare($query);

			$rep->execute($params);
		}

		return $rep->rowCount();
	}

	public static function scallar($query, $params = array())
	{

		if (!$params)

			$rep = self::getPDO()->query($query);

		else {

			$rep = self::getPDO()->prepare($query);

			$rep->execute($params);
		}

		$data = $rep->fetch();

		if (!empty($data) && count($data) > 0) return $data[0];

		return null;
	}



	// Returns the ID of the last inserted Element

	public static function LastInsertedId()
	{

		return self::scallar('select last_insert_id()');
	}



	// Privates

	// Class can not be Instanciated anywhere other than in the class itself

	private function __construct()
	{
		$this->config = Config::get('db');
		try {

			if (file_exists(_basepath . "config/database.php")) {
				$dbs_configs = require_once  _basepath . "config/database.php";

				if (isset($dbs_configs[_school_alias])) {
					$this->config = $dbs_configs[_school_alias];
				}
			}

			if (!$this->config) {
				new Exception("Unknown database ", 500);
			}

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$this->pdo = new PDO('mysql:host=' . $this->config['dbserver'] . ';port=' . $this->config['port'] . ';dbname=' . $this->config['db'], $this->config['dbuser'], $this->config['dbpass'], $pdo_options);
		} catch (Exception $e) {

			die('MySQL Error :' . PHP_EOL . $e->getMessage());
		}

		// Sets UTF8 as default encoding for the next queries
		// $this->pdo->query('SET NAMES `utf8`');
		$this->pdo->query('SET NAMES `utf8mb4`');
	}

	public static  function getConfig()
	{

		return self::getInstance()->config;
	}
}
