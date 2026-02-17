<?php

/**
 * Controller Class 
 */

class ContentController
{

	function __construct()
	{
		$_SESSION['flash_error'] = NULL;
	}

	function index()
	{

		return loadView('publications', array(), 'layout');
    }
    function detail()
	{

		return loadView('blog_detail', array(), 'layout');
    }
}

/* Router options */
$action = Request::getArgs(0) ? Request::getArgs(0) : 'index';
$id = Request::getArgs(1);
// $args['id'] = $id;

#call the proper action
try {
	
	if(!method_exists('ContentController', $action))
		throw new Exception("Error Processing Request", 1);
	
	$controller = new ContentController;
	$controller->{$action}($id);
	
} catch (Exception $e) {
	
	print_r($e);exit;
	
	if (function_exists('http_response_code'))
		http_response_code(404);
	loadView404();
}