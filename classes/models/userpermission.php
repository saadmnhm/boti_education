<?php

namespace Models;

class UserPermission extends Model
{

	protected static $sqlQueries = array();

	protected static $table = 'userpermissions';
	protected static $pk = array(
		'ID' => array(
			'auto' => true,
		),
	);
	protected static $fields = array(
		'TypePermission' => array(
			'fk' => 'TypePermission',
		),
		'Collaborateur' => array(
			'fk' => 'Collaborateur',
		),
		'DateDebut' => array(
			'type' => 'datetime',
		),
		'DateFin' => array(
			'type' => 'datetime',
		),
		'Jours' => array(
			'type' => 'int',
		),
		'PermissionEnHeure' => array(
			'type' => 'boolean',
		),
		'DateAjout' => array(
			'type' => 'datetime',
		),
		'UserAjout' => array(
			'fk' => 'User',
			'type' => 'int',
		),
		'Motif' => array(
			'type' => 'varchar',
		),
		'CommentaireAdmin' => array(
			'type' => 'varchar',
		),
		'AdminValidationDate' => array(
			'type' => 'datetime',
		),
		'AdminValidationUser' => array(
			'fk' => 'User',
			'type' => 'int',
		),
		'AdminRefusDate' => array(
			'type' => 'datetime',
		),
		'AdminRefusUser' => array(
			'fk' => 'User',
			'type' => 'int',
		),
	);

	public function getDureeInterval()
	{
		$hrs = floor($this->get('Jours'));
		$mins = ($this->get('Jours') - $hrs) * 60;
		// exit('PT'.$hrs.'H'.$mins.'M');
		return new \DateInterval('PT' . $hrs . 'H10M');
	}
	
}
