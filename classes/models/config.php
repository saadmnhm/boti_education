<?php
namespace Models;

class Config extends Model {

	protected static $sqlQueries = array();

	protected static $table = 'configs';
	protected static $pk = array(
		'ID' => array(
			'auto' => true,
		),
	);
	protected static $fields = array(
		'Type' => array(
			'type' => 'varchar',
		),
		'Alias' => array(
			'type' => 'varchar',
		),
		'Label' => array(
			'type' => 'varchar',
		),
		'Value' => array(
			'type' => 'text',
		),
	);		public static function getByAlias($alias) {		$id = \DB::scallar('SELECT `ID` FROM '.static::wrapField(static::$table). ' WHERE `Alias`=?', array($alias));		if (!$id)			return null;		return new self($id);	}	public static function getValue($alias) {		$item = Config::getByAlias($alias);		if ($item)			return $item->get('Value');				return null;	}	
}
