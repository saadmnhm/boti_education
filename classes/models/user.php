<?php

namespace Models;

use Exception;

class User extends Model
{
	protected static $sqlQueries = array();
	protected static $table = 'users';
	protected static $pk = array(
		'ID' => array(
			'auto' => true,
		),
	);
	protected static $fields = array(
		'Sup' => array(
			'fk' => 'User',
		),
		'Role' => array(
			'fk' => 'Role',
		),
		'Etablissement' => array(
			'fk' => 'Etablissement',
		),
		'CodePointage'  => array(
			'type' => 'varchar',
		),
		'Login' => array(
			'type' => 'varchar',
		),
		'Password' => array(
			'type' => 'varchar',
		),
		'Key' => array(
			'type' => 'varchar',
			'required' => true,
		),
		'Forgot' => array(
			'type' => 'varchar',
		),
		/*'Fingerprint' => array(
			'type' => 'text',
		),*/
		'TokenID' => array(
			'type' => 'varchar',
		),
		'TokenDevice' => array(
			'type' => 'varchar',
		),
		'Nom' => array(
			'type' => 'varchar',
		),
		'Prenom' => array(
			'type' => 'varchar',
		),
		'Email' => array(
			'type' => 'varchar',
		),
		'Tel' => array(
			'type' => 'varchar',
		),
		'Adresse' => array(
			'type' => 'varchar',
		),
		'Fonction' => array(
			'type' => 'varchar',
		),
		/*'CIN' => array(
			'type' => 'varchar',
		),*/
		'Image' => array(
			'type' => 'varchar',
		),
		'DateNaissance' => array(
			'type' => 'date',
		),
		'Homme' => array(
			'type' => 'boolean',
		),

		'Enabled' => array(
			'type' => 'boolean',
		),
		'ReceiveTaskNotification' => array(
			'type' => 'boolean',
		),
		/*'Valide' => array(
			'type' => 'boolean',
		),*/
		'Date' => array(
			'type' => 'datetime',
			// 'default' => date('Y-m-d H:i:s'),
		),
	);
	public function getEtablissement()
	{
		$etablissement = "-";
		if ((NULL !=  $this->get("Etablissement")))
			$etablissement = $this->get("Etablissement")->get("Label");


		return $etablissement;
	}


	public function getTaches()
	{

		return TacheCollaborateur::getList(array('where' => array('User' => $this->get('ID'))));
	}

	public function isMyTache($tache)
	{
		$taches = TacheCollaborateur::getList(array('where' => array('User' => $this->get('ID'), 'Tache' => $tache)));
		return !empty($taches);
	}

	public function getCollaborateur()
	{

		$collaborateur = Collaborateur::getList(array('where' => array('User' => $this->get('ID'))));
		if (!$collaborateur)
			return null;
		return $collaborateur[0];
	}

	public function getImage()
	{
		if (!$this->get('Image')) {
			$image = 'no-logo.jpg';


			return \URL::base() . \Config::get('path-images-users') . $image;
		}
		return \URL::base() . \Config::get('path-images-users') . $this->get('Image');
	}

	public function getDefaultImage()
	{
		if ($this->get('Homme'))
			$image = 'no-user-man.jpg';
		else
			$image = 'no-user-woman.jpg';
		return \URL::base() . \Config::get('path-images-users') . $image;
	}

	//---------------------User
	public function isComplete()
	{
		if (
			$this->get('Tel') && $this->get('Email') && $this->get('DateNaissance')
			&& $this->hasDocument()
		) {
			return true;
		}
	}

	//---------------------Documents

	public function hasDocument()
	{
		return (Document::getList(array('where' => array('User' => $this->get('ID'))))) != null;
	}

	public function getValideDocumentByTtpe($type)
	{
		$document = Document::getList(array('where' => array('User' => $this->get('ID'), 'Type' => $type)));
		if ($document)
			$document = $document[0];
		return $document;
	}

	public function valideDocuments()
	{
		$etatDocs = false;
		$docs = Document::getList(array('where' => array('User' => $this->get('ID'), 'Valide' => true)));
		if ($docs)
			$etatDocs = true;
		return $etatDocs;
	}


	public function valideDocument($type)
	{
		$etatDocs = false;
		$docs = Document::getList(array('where' => array('User' => $this->get('ID'), 'Valide' => true, 'Type' => $type)));
		if ($docs)
			$etatDocs = true;
		return $etatDocs;
	}

	public function getvalideDocument()
	{
		$doc = null;
		$docs = Document::getList(array('where' => array('User' => $this->get('ID'), 'Valide' => true)));
		if ($docs)
			$doc = $docs[0];
		return $doc;
	}
	
	public function getSmallImage()
	{
		if (!$this->get('Image')) {
			if ($this->get('Homme'))
				$image = 'no-image.jpg';
			else
				$image = 'no-image.jpg';
			return \URL::base() . \Config::get('path-images-users') . $image;
		}
		return \URL::base() . \Config::get('path-images-users') . 'small-' . $this->get('Image');
	}

	public function hasPvIn($date)
	{
		$res = Pv::getList(array('where' => array('User' => $this->get('ID'), 'Date' => $date)));
		return count($res) ? $res[0] : null;
	}


	public function remotlyWorked($date)
	{
		$res = Adistance::getList(array('where' => array('User' => $this->get('ID'), 'Date' => $date)));
		return count($res) ? $res[0] : null;
	}

	public function workRemotlyToday()
	{
		return $this->remotlyWorked(date('Y-m-d'));
	}

	public function hasPermission($date)
	{
		if (!$this->getCollaborateur()) {
			return null;
		}
		$pemissions = UserPermission::getList(array('where' => array("'$date' BETWEEN DateDebut and DateFin and Collaborateur=" . $this->getCollaborateur()->get('ID'))));

		return count($pemissions) ? $pemissions[0] : null;
	}


	public function timeWorked($date)
	{
		$res = Pointage::getList(array('where' => array('User' => $this->get('ID'), 'Etablissement' => $this->get('Etablissement')->get('ID'), 'Date' => $date)));
		return count($res) ? $res[0] : null;
	}


	public function hasSyntheseIn($date)
	{
		$res = Synthese::getList(array('where' => array('CollaborateurUser' => $this->get('ID'), 'Date' => $date)));
		return count($res) ? $res[0] : null;
	}


	public function hasPvToday()
	{
		return $this->hasPvIn(date('Y-m-d'));
	}


	public function hasSyntheseToday()
	{
		return $this->hasSyntheseIn(date('Y-m-d'));
	}

	//---------------------Divers
	public function getNomComplet()
	{
		return implode(' ', array($this->get('Prenom'), $this->get('Nom')));
	}

	public function getPseudo()
	{
		return substr($this->get('Prenom'), 0, 1) . '' . substr($this->get('Nom'), 0, 1);
	}

	//---------------------Authentification
	public static function auth($login, $password)
	{
		$query = 'SELECT `ID` FROM `users` WHERE (`Login`=:login OR `Email`=:login) AND `Password`=SHA1(CONCAT(:password,`Key`)) ORDER BY Nom DESC';

		$params = array('login' => $login, 'password' => $password);

		$userid = \DB::scallar($query, $params);

		if (!$userid)
			return NULL;
		return new self($userid);
	}


	public static function checkPassword($id, $password)
	{
		$query = 'SELECT `ID` FROM `users` WHERE `ID`=:id AND `Password`=SHA1(CONCAT(:password,`Key`))';

		$params = array('id' => $id, 'password' => $password);

		return \DB::scallar($query, $params);
	}

	//---------------------Check Unique Values
	public static function loginExists($login)
	{
		$database = \DB::getInstance();

		$query = 'SELECT `ID` FROM `users` WHERE `Login`=?';
		$params = array($login);

		return \DB::scallar($query, $params);
	}


	public static function emailExists($email)
	{
		$database = \DB::getInstance();

		$query = 'SELECT `ID` FROM `users` WHERE `Email`=?';
		$params = array($email);

		return \DB::scallar($query, $params);
	}
	public static function telExists($tel)
	{
		$database = \DB::getInstance();

		$query = 'SELECT `ID` FROM `users` WHERE `Tel`=?';
		$params = array($tel);

		return \DB::scallar($query, $params);
	}
	public static function keyExists($key)
	{
		$database = \DB::getInstance();

		$query = 'SELECT `ID` FROM `users` WHERE `Key`=?';
		$params = array($key);

		$userid = \DB::scallar($query, $params);

		if (!$userid)
			return NULL;

		return new self($userid);
	}

	//---------------------Récuperation Objets

	public static function getByKeyForgot($keyforgot)
	{
		if (!$keyforgot)
			return null;
		$users = User::getList(array('where' => array('Forgot' => $keyforgot)));
		if (!$users)
			return null;
		return $users[0];
	}
	//--------------------- Cagnottes
	public function getCagnottes()
	{
		$cagnottes = Cagnotte::getList(array('where' => array('Organisateur' => $this->get('ID'))));
		if (!$cagnottes) {
			return null;
		}
		return $cagnottes;
	}

	public function getCagnottesCount()
	{
		$cagnotteCount = Cagnotte::getCount(array('where' => array('Organisateur' => $this->get('ID'))));
		if (!$cagnotteCount)
			$cagnotteCount = 0;
		return $cagnotteCount;
	}
	public function getCagnottesSome()
	{
		$total = \DB::scallar('SELECT SUM(Montant) FROM depenses WHERE User=' . $this->get('ID'));
		return $total;
	}
	//--------------------- participations
	public function getparticipations()
	{
		$participations = Participation::getList(array('where' => array('User' => $this->get('ID'))));
		if (!$participations) {
			return null;
		}
		return $participations;
	}

	public function getparticipationsCount()
	{
		$participationsCount = Participation::getCount(array('where' => array('User' => $this->get('ID'))));
		if (!$participationsCount)
			$participationsCount = 0;
		return $participationsCount;
	}

	public function isParticipant()
	{
		if ($this->getparticipations()) {
			return true;
		}
	}

	public function isOrganisateur()
	{
		if ($this->getCagnottes()) {
			return true;
		}
	}

	public function getLastCagnotte()
	{
		$cagnottes = Cagnotte::getList(array('order' => array('Date' => false)));
		return $cagnottes[0];
	}

	//public function getRegion(){
	//$region = "-";
	//if(( NULL!=  $this->get("Region")))
	//	$region = $this->get("Region")->get("Label");


	//return $region;
	//}
	public function getProvince()
	{
		$province = "-";
		if ((NULL !=  $this->get("Province")))
			$province = $this->get("Province")->get("Label");


		return $province;
	}
	public function getConnexions()
	{
		return Connexion::getList(array('where' => array('User' => $this->get('ID'))));
	}
	public function getPostViews()
	{
		return PostView::getList(array('where' => array('User' => $this->get('ID'))));
	}
	public function getDownloads()
	{
		return DocumentDownload::getList(array('where' => array('User' => $this->get('ID'))));
	}

	public function isRespProvince($province)
	{
		if (roleIs('responsable-province') && ($this->get('Province')->get('ID') == $province->get('ID')))
			return true;
	}
	public function isRespRegion($region)
	{
		if (roleIs('responsable-region') && $this->get('Region')->get('ID') == $region->get('ID'))
			return true;
	}
	public function is($alais)
	{

		return $this->get('Role')->get('Alias') == $alais;
	}

	public function getSubCollaborateurs()
	{

		return User::getList(array('where' => array('Sup' => $this->get('ID'))));
	}

	public function getSubCollaborateur($id)
	{

		$list = User::getList(array('where' => array('Sup' => $this->get('ID'), 'ID' => $id)));
		return count($list) ? $list[0] : null;
	}
}
