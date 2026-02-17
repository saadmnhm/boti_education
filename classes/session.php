<?php
class Session
{

	private $loggedIn = null;
	private $curUser = null;

	// Singletone Implementation
	public static function getInstance()
	{
		static $instance = null;
		if ($instance === null) {
			$instance = new self();
		}
		return $instance;
	}

	public function isLoggedIn()
	{
		return $this->loggedIn;
	}

	public function getCurUser()
	{
		if (!$this->isLoggedIn()) return null;
		return $this->curUser;
	}

	public function setCurUser($user)
	{
		$this->curUser = $user;
		$_SESSION['curuser'] = $this->curUser->getPK();
		$this->loggedIn = true;
	}

	public function unsetCurUser()
	{
		$this->curUser = null;
		$this->loggedIn = false;
		unset($_SESSION['curuser']);
	}

	public function getCurRole()
	{
		if (!$this->isLoggedIn()) return null;
		if (!$this->curUser->get('Role'))
			return null;
		return $this->curUser->get('Role');
	}


	public function getCurRoleAlias()
	{
		if (!$this->getCurRole())
			return null;
		return $this->getCurRole()->get('Alias');
	}

	public function requireLogin()
	{
		if ($this->loggedIn) return;
		global $depth;
		if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']) {
			$_SESSION['ref'] = $_SERVER['REQUEST_URI'];
		}
		URL::redirect(URL::link('login'));
	}

	public function checkPrivilege()
	{
		die('NOT YET IMPLEMENTED');
	}

	public static function user()
	{

		return self::getInstance()->getCurUser();
	}

	// Private
	private function __construct()
	{
		$this->loggedIn = false;
		if (!isset($_SESSION['curuser']))
			return;
		if (!$_SESSION['curuser'])
			return;

		try {
			$user = new Models\User($_SESSION['curuser']);
		} catch (Exception $e) {
			$this->unsetCurUser();
			return;
		}

		self::setCurUser($user);
	}
}
