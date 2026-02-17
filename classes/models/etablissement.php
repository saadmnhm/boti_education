<?php
namespace Models;

class Etablissement extends Model {

	protected static $sqlQueries = array();

	protected static $table = 'etablissements';
	protected static $pk = array(
		'ID' => array(
			'auto' => true,
		),
	);
	protected static $fields = array(
		'Label' => array(
			'type' => 'varchar',
		),	
		'Abreviation' => array(
				'type' => 'varchar',	
		),
		'Logo' => array(
			'type' => 'varchar',
		),
		'OrdreTBD' => array(
			'type' => 'varchar',
		),
		'IP_Adress' => array(
			'type' => 'varchar',
		),
		'Port' => array(
			'type' => 'varchar',
		),
		'Index' => array(
			'type' => 'varchar',
		),
	);

	public function getLogo() {
		if(!$this->get('Logo')){
			return \URL::base() . \Config::get('path-logo-etablissements') . 'no-logo.jpg';
		}
		return \URL::base() . \Config::get('path-logo-etablissements') . $this->get('Logo');
	}

	public function getTachesByEtat($etatID = null){
		$where = array();
		$where['Etablissement'] = $this->get('ID');
		if($etatID){
			$where['Etat'] = $etatID;
		}
		return Tache::getCount( array( 'where' => $where ) );
	}

	public function getCollaboratuerCount(){
		return Collaborateur::getCount( array( 'where' => array( 'Etablissement' => $this->get('ID') ) ) );
	}
}
