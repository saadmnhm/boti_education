<?php

/**
 * Controller Class 
 */

class ContentController
{
	function __construct()
	{
		Session::getInstance()->requireLogin(true);
		if (Request::isPost()) {

			$_SESSION['flash_error'] = NULL;
			$_SESSION['previous_post'] = NULL;
		}
	}
	private $config = array(
		'label' => array(
			'label' => 'Label',
			'filter' => 'trim|strip_tags'
		),
	);
	function index()
	{

		$auth = Session::getInstance()->getCurUser();
		if (!$auth->is('admin')) {
			return URL::redirect(URL::admin(Config::get('default_path_collaborateurs')));
		}

		$data = array();
		$data['navKey'] = 'etablissements';
		$data['etablissements'] = Models\Etablissement::getList();
		//print_r($data['etablissements']);exit;
		return loadView('etablissements/etablissements-list', isset($data) ? $data : NULL);
	}

	function view($id = 0)
	{

		$auth = Session::getInstance()->getCurUser();
		if (!$auth->is('admin')) {
			return URL::redirect(URL::admin(Config::get('default_path_collaborateurs')));
		}

		if ($id > 0) {
			try {
				$etablissement = new Models\Etablissement($id);
			} catch (Exception $e) {
				throw new Exception("Not Found Item", 404);
			}

			$data['navKey'] = 'etablissements';
			$data['etablissement'] = $etablissement;
			//print_r($data['etablissements']);exit;
			return loadView('etablissements/etablissements-item', isset($data) ? $data : NULL);
		} else {
			throw new Exception("Cannot view Item details", 1);
		}
	}
	function add()
	{
		$controller = new ContentController;
		$controller->{'save'}(null);
	}
	function update($id = NULL)
	{
		$controller = new ContentController;
		$controller->{'save'}($id);
	}
	function save($id = NULL)
	{

		$auth = Session::getInstance()->getCurUser();
		if (!$auth->is('admin')) {
			return URL::redirect(URL::admin(Config::get('default_path_collaborateurs')));
		}

		$pk = (isset($id) && $id) ? $id : null;
		try {
			$etablissement = new Models\Etablissement($pk);
		} catch (Exception $e) {
			throw new Exception("Not Found Item", 404);
		}

		if (Request::isPost()) {
			#Validation 
			$validator = new Validation($this->config);
			if ($validator->run()) {


				$etablissement
					->set('Label', $_POST['label'])
					->set('Abreviation', $_POST['abreviation'])
					->set('IP_Adress', $_POST['ip_adress'])
					->set('Port', $_POST['port'])
					->set('Index', $_POST['index']);

				if (isset($_FILES['logo']) && $_FILES['logo']['error'] != UPLOAD_ERR_NO_FILE) {

					$fileError = Upload::checkUploadImage('logo');
					errorPage($fileError);

					if ($etablissement->get('Logo'))
						Upload::delete(_basepath . Config::get('path-logo-etablissements') . $etablissement->get('Logo'));

					$etablissement->set('Logo', Upload::storeImage('logo', Config::get('path-logo-etablissements')));
				}


				$etablissement->save();
				return URL::redirect(URL::admin('etablissements'));
			} else {
				$_SESSION['flash_error'] =  $validator->getMessage();
				$_SESSION['previous_post'] =  $_POST;
				return URL::redirect(URL::admin("etablissements/update/" . $etablissement->get("ID")));
			}
		} else {

			$data['isUpdate'] = $pk ? true : false;

			try {
				$etablissement = new Models\Etablissement($id);
			} catch (Exception $e) {
				throw new Exception("Not Found Item", 404);
			}

			$data['navKey'] = 'etablissements';
			$data['etablissement'] = $etablissement;
			$data['isUpdate'] = $pk ? true : false;
			$data['message'] = NULL;
			return loadView('etablissements/etablissements-form', isset($data) ? $data : NULL);
		}
	}

	function delete($id = NULL)
	{
		try {
			$etablissement = new Models\Etablissement($id);
		} catch (Exception $e) {
			throw new Exception("Not Found Item", 404);
		}

		$user = Session::getInstance()->getCurUser();

		if (roleIs('admin', 'collaborateur'))
			$etablissement->delete();

		return URL::redirect(URL::admin('etablissements'));
	}
}

/* Router options */
$action = Request::getArgs(0) ? Request::getArgs(0) : 'index';
$id = Request::getArgs(1);
// $args['id'] = $id;

#call the proper action
try {

	if (!method_exists('ContentController', $action))
		throw new Exception("Error Processing Request", 1);

	$controller = new ContentController;
	$controller->{$action}($id);
} catch (Exception $e) {
	echo $e->getMessage();
	echo 500;
	exit;
}
