<?php

// -- Start Session if not already started
if ((function_exists('session_status') && session_status() == PHP_SESSION_NONE) || session_id() == '')
	session_start();

define('_basepath', rtrim(dirname(__FILE__), '\\/') . '/');

require_once _basepath . 'includes/autoload.php';
require_once _basepath . 'includes/functions.php';
require_once _basepath . 'includes/mails.php';
require_once _basepath . 'libs/instagram/Instagram.php';

// ini_set('date.timezone', 'UTC'); // Default Timezone to GMT
ini_set('date.timezone', 'Etc/GMT-1'); // Timezone to GMT + 1

if (Config::get('display-errors'))
	ini_set('display_errors', 'on');

if (roleIs('admin')) {
	Config::set('admin', 'admin');
}

$app = array();
$app['url'] = array();
$app['url']['base'] = URL::base();
$app['url']['link'] = URL::link();
$app['url']['admin'] = URL::admin();
$app['url']['absolute'] = URL::absolute(URL::base());
$app['pointageLabels'] = array();
if (Request::isAdmin()) {
	if (!file_exists(_basepath . Config::get('admin') . '/' . Request::getView() . '.php')) {
		URL::redirect(URL::link());
	}
	include _basepath . Config::get('admin') . '/' . Request::getView() . '.php';
	exit;
}


if (!file_exists(_basepath . Request::getView() . '.php')) {
	URL::redirect(URL::link());
}


include _basepath . Request::getView() . '.php';
