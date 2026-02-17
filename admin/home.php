<?php 

/**
 * Controller Class 
 */

use Models\Conge;



class ContentController
{
	
	function __construct()
	{
		Session::getInstance()->requireLogin(true);
		if(Request::isPost()){

			$_SESSION['flash_error'] = NULL;
			$_SESSION['previous_post'] = NULL;
		}
	}

	function index(){
		$auth = Session::getInstance()->getCurUser();
		$data = array(); 
		$data['navKey'] = 'home';
		$data['etablissements'] = Models\Etablissement::getList();
		
		return loadView('home', isset($data) ? $data : NULL );
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
	echo $e->getMessage();
	echo 500;
	exit;
}
