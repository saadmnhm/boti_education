<?php
class DB {

	private $pdo=null;

	// Singletone Implementation
	public static function getInstance() {
		static $instance = null;
		if ($instance === null) {
			$instance = new self();
		}
		return $instance;
	}

	// Returns PDO Object
	public static function getPDO() {
		return self::getInstance()->pdo;
	}

	// Transaction
	public static function begin() {
		return self::getPDO()->query('BEGIN');
	}
	public static function commit() {
		return self::getPDO()->query('COMMIT');
	}
	public static function rollback() {
		return self::getPDO()->query('ROLLBACK');
	}

	// Database Access Functions
	public static function reader($query, $params = NULL) {
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

	public static function noQuery($query, $params = NULL) {
		if (!$params)
			$rep = self::getPDO()->query($query);
		else {
			$rep = self::getPDO()->prepare($query);
			$rep->execute($params);
		}
		return $rep->rowCount();
	}
	public static function scallar($query,$params = array()) {
		if (!$params)
			$rep = self::getPDO()->query($query);
		else {
			$rep = self::getPDO()->prepare($query);
			$rep->execute($params);
		}
		$data = $rep->fetch();
		if (!empty($data) && count($data)>0) return $data[0];
		return null;
	}

	// Returns the ID of the last inserted Element
	public static function LastInsertedId() {
		return self::scallar('select last_insert_id()');
	}

	// Privates
	// Class can not be Instanciated anywhere other than in the class itself
	private function __construct() {
		try {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$this->pdo = new PDO('mysql:host='.Config::get('dbserver').';dbname='.Config::get('db').'', Config::get('dbuser'), Config::get('dbpass'), $pdo_options);
		}
		catch (Exception $e) {
			die('MySQL Error :' . PHP_EOL . $e->getMessage());
		}
		// Sets UTF8 as default encoding for the next queries
		$this->pdo->query('SET NAMES `utf8`');
	}
}
