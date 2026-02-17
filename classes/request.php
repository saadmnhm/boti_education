<?php
class Request {

	// Uri properties
	private $method = false;
	private $scheme = false;
	private $domain = false;
	private $fulluri = false;
	private $base = false;
	private $admin = false;
	private $lang = false;
	private $uri = false;

	// HTML Request Type
	private $query = false;
	private $ajax = null;

	// Custom Routes
	private $routes = false;

	// URI Segments
	private $segments = false;
	private $rsegments = false;

	// View
	private $view = null;
	private $args = null;

	// Singletone Implementation
	public static function getInstance() {
		static $instance = null;
		if ($instance === null) {
			$instance = new self();
		}
		return $instance;
	}
	// Custom Code for Routing
	public static function registerRoute() {

	}

	public static function getMethod() {
		if (self::getInstance()->method === false) {
			if (isset($_SERVER['REQUEST_METHOD']))
				self::getInstance()->method = $_SERVER['REQUEST_METHOD'];
			else
				self::getInstance()->method = null;
		}
		return self::getInstance()->method;
	}
	public static function getScheme() {
		if (self::getInstance()->scheme === false) {
			self::getInstance()->scheme = 'http';
			if (isset($_SERVER['https']) && $_SERVER['https'] != 'off')
				self::getInstance()->scheme .= 's';
		}
		return self::getInstance()->scheme;
	}
	public static function getDomain() {
		if (self::getInstance()->domain === false) {
			if (isset($_SERVER['HTTP_HOST']))
				self::getInstance()->domain = $_SERVER['HTTP_HOST'];
			else
				self::getInstance()->domain = null;
		}
		return self::getInstance()->domain;
	}
	public static function getFullURI() {
		return self::getInstance()->fulluri;
	}
	public static function getBase() {
		return self::getInstance()->base;
	}
	public static function isAdmin() {
		return self::getInstance()->admin;
	}
	public static function getLang() {
		return self::getInstance()->lang;
	}
	public static function getURI() {
		return self::getInstance()->uri;
	}
	public static function getQuery() {
		return self::getInstance()->query;
	}
	public static function isPost() {
		return self::getMethod() == 'POST';
	}
	public static function isAjax() {
		if (self::getInstance()->ajax === null) {
			if (isset($_SERVER['X-Requested-With']) && strtolower($_SERVER['X-Requested-With']) == 'xmlhttprequest')
				self::getInstance()->ajax = true;
			elseif (isset($_SERVER['HTTP_X-Requested-With']) && strtolower($_SERVER['HTTP_X-Requested-With']) == 'xmlhttprequest')
				self::getInstance()->ajax = true;
			else
				self::getInstance()->ajax = false;
		}
		return self::getInstance()->ajax;
	}

	public static function getView() {
		return self::getInstance()->view;
	}
	public static function getArgs($index=null) {
		if ($index !== null)
			return isset(self::getInstance()->args[$index])?self::getInstance()->args[$index]:null;
		return self::getInstance()->args;
	}

	// Privates
	private function __construct() {
		if (!isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME'])) {
			$this->fulluri = '/';
			$this->uri = '/';
			$this->query = null;
			return $this;
		}
		$this->fulluri = $_SERVER['REQUEST_URI'];
		
		filter_scripts($_POST);
		// secure_fg_profile_sh($_POST);
		// secure_csrf($_POST);

		$uri = parse_url($this->fulluri);
		$this->query = isset($uri['query']) ? $uri['query'] : null;
		$uri = isset($uri['path']) ? $uri['path'] : '/';

		if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
			$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			$this->base = $_SERVER['SCRIPT_NAME'];
		}
		elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
			$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			$this->base = dirname($_SERVER['SCRIPT_NAME']);
		}

		$this->base = rtrim($this->base, '/\\').'/';
		$this->uri = ltrim($uri, '/');

		// Routing
		$routesFilePath = realpath(dirname(__FILE__).'/..').DIRECTORY_SEPARATOR.'config/urls.php';
		if (!is_readable($routesFilePath))
			throw new Exception('Could not load Routes file');
		$this->routes = require $routesFilePath;

		$this->segments = explode('/', trim($this->uri, '/'));
		
		if ($this->segments[0] == Config::get('admin')) {
			$this->admin = true;
			$this->segments = array_slice($this->segments, 1);
		}
		elseif (preg_match('#^[a-z]{2}$#i', $this->segments[0])) {
			$this->lang = $this->segments[0];
			$this->segments = array_slice($this->segments, 1);
		}

		$this->uri = $uri = implode('/', $this->segments);

		if (!$this->admin) {
			foreach ($this->routes as $k => $v) {
				$reg = '#^'.$k.'$#';
				if (preg_match($reg, $uri)) {
					$uri = preg_replace($reg, $v, $uri);
					break;
				}
			}
		}

		$this->rsegments = explode('/', trim($uri, '/'));
		if (count($this->rsegments) > 0) {
			$this->view = $this->rsegments[0];
			if (count($this->rsegments) > 1) {
				$this->args = array_slice($this->rsegments, 1);
			}
		}
		$this->view = $this->view?$this->view:'home';
		$this->args = $this->args?$this->args:array();
	}


	public static function get($key)
	{
		return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
	}

	public static function has($key)
	{
		return isset($_REQUEST[$key]);
	}
	
}
