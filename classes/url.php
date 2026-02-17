<?php
class URL
{

	// Singletone Implementation
	public static function getInstance()
	{
		static $instance = null;
		if ($instance === null) {
			$instance = new self();
		}
		return $instance;
	}

	public static function redirect($link)
	{
		header('location: ' . $link);
		exit;
	}
	public static function canonical($link)
	{ // send a 301 redirect, to the correct link
		if ($_SERVER['REQUEST_URI'] != $link && !Request::isPost()) {
			header('HTTP/1.1 301 Moved Permanently');
			self::redirect($link);
		}
	}
	public static function response($code = 404)
	{
		if (function_exists('http_response_code'))
			http_response_code($code);
		loadView(
			'html-error',
			array(
				'pageTitle' => 'Page Introuvable - ' . Config::get('sitename'),
				'code' => $code,
			)
		);
	}

	public static function absolute($link = null, $domain = null, $secure = null)
	{


		if (self::isUrl($link)) {
			return $link;
		}

		$url = '';
		if ($secure !== null)
			$url .= 'http' . ($secure ? 's' : '');
		else
			$url .= Request::getScheme();
		$url .= '://';

		if ($domain)
			$url .= $domain;
		else
			$url .= Request::getDomain();
		$url .= $link;
		return $url;
	}


	public static function AbsoluteLink($link = null)
	{


		if (self::isUrl($link)) {
			return $link;
		}


		return Request::getScheme() . '://' . Request::getDomain() . Request::getBase() . $link;
	}

	public static function base($link = null)
	{

		if (self::isUrl($link)) {
			return $link;
		}


		return Request::getBase() . $link;
	}


	public static function link($link = null)
	{

		if (self::isUrl($link)) {
			return $link;
		}

		return self::base($link);
	}

	public static function admin($link = null)
	{

		if (self::isUrl($link)) {
			return $link;
		}


		$admin = Config::has('admin') ? Config::get('admin') : 'admin';
		return self::base($admin . '/' . $link);
	}


	public static function admin_asset($link = null)
	{

		if (self::isUrl($link)) {
			return $link;
		}

		$admin = Config::has('admin_asset') ? Config::get('admin_asset') : 'admin';
		return self::base($admin . '/' . $link);
	}


	public static function back()
	{
		return self::redirect($_SERVER['HTTP_REFERER']);
	}


	public static function isUrl($link)
	{

		if (substr($link, 0, strlen("https")) === "https" || substr($link, 0, strlen("http")) === "http") {
			return true;
		}
		return false;
	}

	public static function download($link)
	{
		// return self::base($link . '&download=true');
		return preg_replace("/\/view\//", "/download/", $link, 1);
	}


	public static function asset($path)
	{
		if (self::isUrl($path)) {
			return $path;
		}

		return URL::base($path);
	}
}
