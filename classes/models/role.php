<?php
namespace Models;

class Role extends Model {

	protected static $sqlQueries = array();

	protected static $table = 'roles';
	protected static $pk = array(
		'ID' => array(
			'auto' => true,
		),
	);
	protected static $fields = array(
		'Parent' => array(
			'fk' => 'Role',
		),
		'Label' => array(
			'type' => 'varchar',
		),
		'Alias' => array(
			'type' => 'varchar',
		),
	);
}
