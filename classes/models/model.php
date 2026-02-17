<?php

namespace Models;

abstract class Model
{

	protected static $table = null;
	protected static $pk = null;
	protected static $fields = array();
	protected static $tableI18n = array();
	protected static $pkI18n = array();
	protected static $fieldsI18n = array();

	protected static $sqlQueries = null;

	protected static $softDelete = true;

	protected $attrs = array();
	protected $attrsI18n = array();
	protected $saved = false;

	protected static $pkDefinition = array(
		'type' => 'int',
		'required' => true,
		'auto' => false,
		'fk' => null,
		'hash' => false,
	);

	protected static $fieldDefinition = array(
		'type' => 'varchar',
		'fk' => null,
		'required' => false,
		'default' => null,
		'form' => null,
		'hash' => false,
	);
	protected static $fieldI18nDefinition = array(
		'type' => 'varchar',
		'required' => false,
		'default' => null,
	);

	public function __construct($pk = null, $checkHash = true)
	{
		foreach (static::pk() as $field => $cfg)
			$this->attrs[$field] = null;
		foreach (static::fields() as $field => $cfg)
			$this->attrs[$field] = null;
		if ($pk !== null) {

			if ($result = ModelCache::get(get_class($this), $pk)) {

				$this->load($result);

				if (static::fieldsI18n())
					$this->loadI18n();
				$this->saved = true;
			} else {

				if (is_array($pk))
					$params = $pk;
				else
					$params = array($pk);

				if ($checkHash) {
					$ind = 0;
					foreach (static::pk() as $field => $cfg) {
						if ($cfg['hash'] && !$cfg['fk']) {
							loadLib('hashids');
							$hashKey = \Config::get('hashsecretkey');
							if (is_string($cfg['hash']))
								$hashKey .= $cfg['hash'];
							$hashids = new \Hashids\Hashids($hashKey, \Config::get('hashlength'), \Config::get('hashchars'));
							$decode = $hashids->decode($params[$ind]);
							if (!$decode)
								throw new \Exception('Object could not be loaded ' . get_class($this) . " Ref " . $pk);
							$params[$ind] = $decode[0];
						}
						$ind++;
					}
				}

				$result = \DB::reader(static::sqlQueryByPK(), $params);
				if (!$result)
					throw new \Exception('Object could not be loaded ' . get_class($this) . " Ref " . $pk);

				$this->load($result[0]);

				ModelCache::set(get_class($this), $pk, $result[0]);
				if (static::fieldsI18n())
					$this->loadI18n();

				$this->saved = true;
			}
		}
	}

	private static $classes = array();


	public static function init()
	{
		if (array_key_exists(get_called_class(), self::$classes))
			return true;
		if (!static::$pk && !static::$fields)
			throw new \Exception('No fields defined');
		foreach (static::$pk as $field => &$cfg)
			$cfg += static::$pkDefinition;
		foreach (static::$fields as $field => &$cfg)
			$cfg += static::$fieldDefinition;
		if (static::$fieldsI18n) {
			foreach (static::$fieldsI18n as $field => &$cfg)
				$cfg += static::$fieldI18nDefinition;
		}
		self::$classes[get_called_class()] = count(self::$classes);
	}

	// Fields
	public static function pk($field = null, $throw = null)
	{
		static::init();
		if ($field) {
			if (array_key_exists($field, static::pk()))
				return static::$pk[$field];
			if ($throw)
				throw new \Exception('Unknown field: "' . $field . '"');
			return null;
		}
		return static::$pk;
	}
	public static function fields($field = null, $throw = null)
	{
		static::init();
		if ($field) {
			if (array_key_exists($field, static::fields()))
				return static::$fields[$field];
			if ($throw)
				throw new \Exception('Unknown field: "' . $field . '"');
			return null;
		}
		return static::$fields;
	}
	public static function pkI18n()
	{
		static::init();
		return static::$pkI18n;
	}
	public static function fieldsI18n($field = null, $throw = null)
	{
		static::init();
		if ($field) {
			if (array_key_exists($field, static::fieldsI18n()))
				return static::$fieldsI18n[$field];
			if ($throw)
				throw new \Exception('Unknown field: "' . $field . '"');
			return null;
		}
		return static::$fieldsI18n;
	}

	public static function fieldExists($field, $throw = false)
	{
		if (array_key_exists($field, static::pk()))
			return true;
		if (array_key_exists($field, static::fields()))
			return true;
		if ($throw)
			throw new \Exception('Field not found');
		return false;
	}
	public static function fieldI18nExists($field, $throw = false)
	{
		if (array_key_exists($field, static::pkI18n()))
			return true;
		if (array_key_exists($field, static::fieldsI18n()))
			return true;
		if ($throw)
			throw new \Exception('Field not found');
		return false;
	}

	public function getPK($implode = true, $hash = true)
	{
		$pks = array();
		foreach (static::pk() as $field => $cfg)
			$pks[] = $this->get($field, null, $hash);
		if ($implode)
			return implode(',', $pks);
		return $pks;
	}
	function getKey()
	{
		return $this->getPk(true);
	}

	public function get($field, $lang = null, $hash = true)
	{
		if (static::fieldExists($field)) {
			$cfg = static::fields($field);
			if (!$cfg)
				$cfg = static::pk($field);
			if ($cfg && $cfg['fk'] && $this->attrs[$field]) {
				$fk = __NAMESPACE__ . '\\' . $cfg['fk'];
				if (!($this->attrs[$field] instanceof $fk)) {
					$this->attrs[$field] = new $fk($this->attrs[$field], false);
				}
			}
			if ($cfg['hash'] && !$cfg['fk'] && $hash) {
				loadLib('hashids');
				$hashKey = \Config::get('hashsecretkey');
				if (is_string($cfg['hash']))
					$hashKey .= $cfg['hash'];
				$hashids = new \Hashids\Hashids($hashKey, \Config::get('hashlength'), \Config::get('hashchars'));
				return $hashids->encode($this->attrs[$field]);
			}
			return $this->attrs[$field];
		}
		if (static::fieldI18nExists($field)) {
			if ($lang === null)
				$lang = Lang::current();
			// $this->loadI18nLang($lang);
			if (!isset($this->attrsI18n[$lang->get('Short')]))
				return null;
			return $this->attrsI18n[$lang->get('Short')][$field];
		}
		throw new \Exception('Unknown Field: ' . $field);
	}

	public function getPrimitive($field)
	{
		if (static::fieldExists($field)) {
			return $this->attrs[$field];
		}
		throw new \Exception('Unknown Field: ' . $field);
	}

	public function set($field, $value, $lang = null)
	{
		if (static::fieldExists($field)) {
			$value = is_bool($value) ? (int)$value : $value;
			$this->attrs[$field] = $value;
			return $this;
		}

		if (static::fieldI18nExists($field)) {
			if ($lang === null)
				throw new \Exception('Language not specified for field: ' . $field);
			if (!array_key_exists($lang->get('Short'), $this->attrsI18n)) {
				foreach (static::fieldsI18n() as $fieldI18n => $cfg)
					$this->attrsI18n[$lang->get('Short')][$fieldI18n] = null;
			}
			$this->attrsI18n[$lang->get('Short')][$field] = $value;
			return $this;
		}

		throw new \Exception('Unknown Field: ' . $field);
	}

	protected function load($data)
	{
		foreach ($this->pk() as $field => $cfg)
			$this->set($field, $data[$field]);
		foreach ($this->fields() as $field => $cfg)
			$this->set($field, $data[$field]);
	}

	protected function loadI18n()
	{
		$params = $this->getPK(false);
		$result = \DB::reader(static::sqlQueryI18n(), $params);
		if (!$result)
			return null;

		foreach ($result as $data) {
			$l = new Lang($data['IDLang']);
			if (!array_key_exists($l->get('Short'), $this->attrsI18n))
				$this->attrsI18n[$l->get('Short')] = array();
			foreach ($this->fieldsI18n() as $field => $cfg)
				$this->set($field, $data[$field], $l);
		}
	}

	protected function loadI18nLang($lang)
	{
		$params = $this->getPK(false);
		$params[] = $lang->get('ID');
		$result = \DB::reader(static::sqlQueryI18nByLang(), $params);
		if (!$result)
			return null;
		$data = $result[0];
		if (!array_key_exists($lang->get('Short'), $this->attrsI18n))
			$this->attrsI18n[$lang->get('Short')] = array();
		foreach ($this->fieldsI18n() as $field => $cfg)
			$this->set($field, $data[$field], $lang);
	}

	public static function handleArgs($args, &$query, &$params)
	{
		if (isset($args['where'])) {
			if (is_array($args['where'])) {
				$conditions = array();
				foreach ($args['where'] as $k => $v) {
					if (!is_numeric($k)) {
						if ($v === null)
							continue;
						$conditions[] = '`' . $k . '` = ?';
						$params[] = is_bool($v) ? (int)$v : $v;
					} else {
						$conditions[] = $v;
					}
				}
				if ($conditions)
					$query .= ' WHERE ' . implode(' AND ', $conditions);
			} elseif (is_string($args['where']))
				$query .= ' WHERE ' . $args['where'];
		}



		return true;
	}

	public static function  modelManager()
	{
		return (new ModelManager(static::class));
	}

	public static function where($where = null)
	{
		return  static::modelManager()->where($where);
	}

	public static function order($order = array())
	{
		return  static::modelManager()->order($order);
	}

	public static function limit($limit = 500)
	{
		return  static::modelManager()->limit($limit);
	}

	public static function  start($start = 0)
	{
		return  static::modelManager()->start($start);
	}

	public static function query()
	{
		return static::modelManager();
	}

	public static function getTable()
	{
		return static::$table;
	}

	public static function getList($args = null, $query = null)
	{
		if (!is_array($args)) $args = array();
		if (!$query)	$query = static::sqlQuery();
		$params = array();

		if (static::fieldExists('DeletedAt') && static::$softDelete) {
			$args['where'][] = "(`DeletedAt` IS NULL)";
		}

		if ($args) {
			static::handleArgs($args, $query, $params);
		}

		if (isset($args['groupBy'])) {
			$groupBy = $args['groupBy'];
			if ($groupBy)
				$query .= ' GROUP BY `' . implode('`,`', $groupBy) . '`';
		}

		if (isset($args['order'])) {
			$order = array();
			if (is_array($args['order'])) {
				foreach ($args['order'] as $k => $v)
					if (!is_numeric($k)) {
						if ($v === null)
							continue;
						$order[] = '`' . $k . '`' . ($v ? 'ASC' : ' DESC');
					} else
						$order[] = $v;
			}
			if ($order)
				$query .= ' ORDER BY ' . implode(', ', $order);
		}

		if (isset($args['limit']) && is_numeric($args['limit']) && $args['limit']) {
			$query .= ' LIMIT ';
			if (isset($args['start']) && is_numeric($args['start']) && $args['start'])
				$query .= $args['start'] . ', ';
			$query .= $args['limit'];
		}

		$resp = \DB::readerFetch($query, $params);
		$class = get_called_class();
		$response = array();
		while ($data = $resp->fetch()) {
			$obj = new $class();
			$obj->load($data);
			if (static::fieldsI18n())
				$obj->loadI18n();
			$obj->saved = true;
			$response[] = $obj;
		}
		return ($response);
	}

	public static function all($args = null, $query = null)
	{
		if (!is_array($args)) $args = array();
		if (!$query)	$query = static::sqlQuery();
		$params = array();

		if ($args) {
			static::handleArgs($args, $query, $params);
		}

		if (isset($args['groupBy'])) {
			$groupBy = $args['groupBy'];
			if ($groupBy)
				$query .= ' GROUP BY `' . implode('`,`', $groupBy) . '`';
		}


		if (isset($args['order'])) {
			$order = array();
			if (is_array($args['order'])) {
				foreach ($args['order'] as $k => $v)
					if (!is_numeric($k)) {
						if ($v === null)
							continue;
						$order[] = '`' . $k . '`' . ($v ? 'ASC' : ' DESC');
					} else
						$order[] = $v;
			}
			if ($order)
				$query .= ' ORDER BY ' . implode(', ', $order);
		}

		if (isset($args['limit']) && is_numeric($args['limit']) && $args['limit']) {
			$query .= ' LIMIT ';
			if (isset($args['start']) && is_numeric($args['start']) && $args['start'])
				$query .= $args['start'] . ', ';
			$query .= $args['limit'];
		}

		$resp = \DB::readerFetch($query, $params);
		$class = get_called_class();
		$response = array();
		while ($data = $resp->fetch()) {
			$obj = new $class();
			$obj->load($data);
			if (static::fieldsI18n())
				$obj->loadI18n();
			$obj->saved = true;
			$response[] = $obj;
		}

		return ($response);
	}

	public static function allCashed($args = null, $query = null)
	{
		if (!is_array($args)) $args = array();
		if (!$query)	$query = static::sqlQuery();
		$params = array();


		if ($args) {
			static::handleArgs($args, $query, $params);
		}

		if (isset($args['groupBy'])) {
			$groupBy = $args['groupBy'];
			if ($groupBy)
				$query .= ' GROUP BY `' . implode('`,`', $groupBy) . '`';
		}


		if (isset($args['order'])) {
			$order = array();
			if (is_array($args['order'])) {
				foreach ($args['order'] as $k => $v)
					if (!is_numeric($k)) {
						if ($v === null)
							continue;
						$order[] = '`' . $k . '`' . ($v ? 'ASC' : ' DESC');
					} else
						$order[] = $v;
			}
			if ($order)
				$query .= ' ORDER BY ' . implode(', ', $order);
		}



		if (isset($args['limit']) && is_numeric($args['limit']) && $args['limit']) {
			$query .= ' LIMIT ';
			if (isset($args['start']) && is_numeric($args['start']) && $args['start'])
				$query .= $args['start'] . ', ';
			$query .= $args['limit'];
		}

		$resp = \DB::readerFetch($query, $params);
		$class = get_called_class();
		$response = array();
		while ($data = $resp->fetch()) {
			$obj = new $class();
			$obj->load($data);
			if (static::fieldsI18n())
				$obj->loadI18n();
			$obj->saved = true;
			$response[] = $obj;
			ModelCache::set($class, $obj->getKey(), $data);
		}

		return ($response);
	}

	public static function allWithKeys($args = null, $query = null)
	{
		if (!is_array($args)) $args = array();
		if (!$query)	$query = static::sqlQuery();
		$params = array();


		if ($args) {
			static::handleArgs($args, $query, $params);
		}

		if (isset($args['groupBy'])) {
			$groupBy = $args['groupBy'];
			if ($groupBy)
				$query .= ' GROUP BY `' . implode('`,`', $groupBy) . '`';
		}


		if (isset($args['order'])) {
			$order = array();
			if (is_array($args['order'])) {
				foreach ($args['order'] as $k => $v)
					if (!is_numeric($k)) {
						if ($v === null)
							continue;
						$order[] = '`' . $k . '`' . ($v ? 'ASC' : ' DESC');
					} else
						$order[] = $v;
			}
			if ($order)
				$query .= ' ORDER BY ' . implode(', ', $order);
		}


		if (isset($args['limit']) && is_numeric($args['limit']) && $args['limit']) {
			$query .= ' LIMIT ';
			if (isset($args['start']) && is_numeric($args['start']) && $args['start'])
				$query .= $args['start'] . ', ';
			$query .= $args['limit'];
		}

		$resp = \DB::readerFetch($query, $params);
		$class = get_called_class();
		$response = array();
		while ($data = $resp->fetch()) {
			$obj = new $class();
			$obj->load($data);
			if (static::fieldsI18n())
				$obj->loadI18n();
			$obj->saved = true;
			$response[$obj->getKey()] = $obj;
			// static::$caches[$class][$obj->getKey()] = $data;
		}
		return ($response);
	}

	public static function printQuery($args = null, $query = null)
	{
		if (!is_array($args)) $args = array();

		if (!$query)
			$query = static::sqlQuery();
		$params = array();

		if ($args) {
			static::handleArgs($args, $query, $params);
			if (isset($args['order'])) {
				$order = array();
				if (is_array($args['order'])) {
					foreach ($args['order'] as $k => $v)
						if (!is_numeric($k)) {
							if ($v === null)
								continue;
							$order[] = '`' . $k . '`' . ($v ? '' : ' DESC');
						} else
							$order[] = $v;
				}
				if ($order)
					$query .= ' ORDER BY ' . implode(', ', $order);
			}
			if (isset($args['limit']) && is_numeric($args['limit']) && $args['limit']) {
				$query .= ' LIMIT ';
				if (isset($args['start']) && is_numeric($args['start']) && $args['start'])
					$query .= $args['start'] . ', ';
				$query .= $args['limit'];
			}
		}

		return ($query);
	}


	public static function getCount($args = null, $query = null)
	{
		if (!is_array($args)) $args = array();

		if (!$query)
			$query = static::sqlQueryCount();
		$params = array();

		if ($args)
			static::handleArgs($args, $query, $params);

		return \DB::scallar($query, $params);
	}

	public function save($update_fields =  null)
	{
		$this->beforeSave();
		$result = $this->saved ? $this->update($update_fields) : $this->insert();
		$this->afterSave();
		return $result;
	}

	protected function insert()
	{

		$params = array();
		foreach (static::pk() as $field => $cfg) {
			if ($cfg['type'] == 'int' && $cfg['auto'])
				continue;
			$value = $this->get($field, null, false);
			if ($cfg['fk'] && $value)
				$value = $value->getPK(true, false);
			if (!$value)
				throw new \Exception('Required value for primary key field "' . $field . '"');
			$this->set($field, $value);
			$params[] = $value;
		}
		foreach (static::fields() as $field => $cfg) {
			$value = $this->get($field, null, false);
			if ($cfg['fk'])
				if ($value)
					$value = $value->getPK(true, false);
				else
					$value = null;
			if ($cfg['required'] && !$value)
				throw new \Exception('Required value for field "' . $field . '"');
			if (!$value && $cfg['default'])
				$value = $cfg['default'];
			if (in_array($cfg['type'], array('varchar', 'date', 'datetime')) && !$value)
				$value = null;
			if (in_array($cfg['type'], array('int')) && !is_numeric($value))
				$value = null;
			$this->set($field, $value);
			$params[] = $value;
		}

		$count = \DB::noQuery(static::sqlInsert(), $params);
		if ($count)
			foreach (static::pk() as $field => $cfg)
				if ($cfg['type'] == 'int' && $cfg['auto'])
					$this->set($field, \DB::lastInsertedId());

		if (static::fieldsI18n())
			static::insertI18n();

		$this->saved = true;

		return $count;
	}

	protected function update($update_fields =  null)
	{

		$count = 0;
		if (static::fields()) {
			$params = array();
			foreach (static::fields() as $field => $cfg) {
				if ($update_fields && !in_array($field, $update_fields)) {
					continue;
				}

				$value = $this->get($field, null, false);
				if ($cfg['fk'])
					if ($value)
						$value = $value->getPK(true, false);
					else
						$value = null;
				if ($cfg['required'] && !$value)
					throw new \Exception('Required value for field "' . $field . '"');
				if (!$value && $cfg['default'])
					$value = $cfg['default'];
				if (in_array($cfg['type'], array('varchar', 'date', 'datetime')) && !$value)
					$value = null;
				if (in_array($cfg['type'], array('int')) && !is_numeric($value))
					$value = null;
				$this->set($field, $value);
				$params[] = $value;
			}
			foreach (static::pk() as $field => $cfg) {
				$value = $this->get($field, null, false);
				if ($cfg['fk'] && $value)
					$value = $value->getPK(true, false);
				$params[] = $value;
			}

			$count = \DB::noQuery(static::sqlUpdate($update_fields), $params);
		}

		if (static::fieldsI18n())
			$count += static::replaceI18n();
		return $count;
	}


	public function softDelete()
	{
		$this->setJson('DeletedAt', array(
			'user' => \Session::user()->get('ID'),
			'date' => date('Y-m-d H:i:s'),
		));
		$this->save();
	}

	public function delete()
	{
		$this->beforeDelete();
		$params = array();
		foreach (static::pk() as $field => $cfg) {
			$value = $this->get($field, null, false);
			if ($cfg['fk'] && $value)
				$value = $value->getPK(true, false);
			$params[] = $value;
		}

		$count = 0;
		if (static::fieldsI18n())
			$count += static::deleteI18n();
		$count += \DB::noQuery(static::sqlDelete(), $params);

		$this->afterDelete();
		return $count;
	}

	protected function replaceI18n()
	{
		$params = array();

		foreach (Lang::getList() as $lang) {
			foreach (static::pkI18n() as $field => $cfg)
				$params[] = $this->get(static::$pkI18n[$field]);
			$params[] = $lang->get('ID');
			foreach (static::fieldsI18n() as $field => $cfg) {
				$value = $this->get($field, $lang);
				if ($value === null && $cfg['default'] !== null)
					$value = $cfg['default'];
				$this->set($field, $value, $lang);
				$params[] = $this->get($field, $lang);
			}
		}

		return \DB::noQuery(static::sqlReplaceI18n(), $params);
	}

	protected function insertI18n()
	{
		$params = array();

		foreach (Lang::getList() as $lang) {
			foreach (static::pkI18n() as $field => $cfg)
				$params[] = $this->get(static::$pkI18n[$field]);
			$params[] = $lang->get('ID');
			foreach (static::fieldsI18n() as $field => $cfg) {
				$value = $this->get($field, $lang);
				if ($value === null && $cfg['default'] !== null)
					$value = $cfg['default'];
				$this->set($field, $value, $lang);
				$params[] = $this->get($field, $lang);
			}
		}

		return \DB::noQuery(static::sqlInsertI18n(), $params);
	}

	protected function updateI18n()
	{
		$count = 0;

		foreach (Lang::getList() as $lang) {
			$params = array();
			foreach (static::fieldsI18n() as $field => $cfg) {
				$value = $this->get($field, $lang);
				if ($value === null && $cfg['default'] !== null)
					$value = $cfg['default'];
				$this->set($field, $value, $lang);
				$params[] = $this->get($field, $lang);
			}
			foreach (static::pkI18n() as $field => $cfg)
				$params[] = $this->get(static::$pkI18n[$field]);
			$params[] = $lang->get('ID');
			$count += \DB::noQuery(static::sqlUpdateI18nByLang(), $params);
		}

		return $count;
	}

	protected function deleteI18n()
	{
		$params = array();

		foreach (static::pkI18n() as $field => $cfg)
			$params[] = $this->get(static::$pkI18n[$field]);

		return \DB::noQuery(static::sqlDeleteI18n(), $params);
	}

	// keep to overide if needed
	protected  function beforeSave()
	{
	}

	protected  function afterSave()
	{
	}

	protected  function beforeDelete()
	{
	}

	protected  function afterDelete()
	{
	}

	// Build queries
	protected static function wrapField($field)
	{
		return '`' . $field . '`';
	}

	public static function sqlQuery($distinct = null)
	{
		if (!array_key_exists('query', static::$sqlQueries)) {
			$sql = 'SELECT ';
			if ($distinct)
				$sql .= ' DISTINCT ';
			$sqlFields = array();
			foreach (static::pk() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			foreach (static::fields() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sql .= implode(',', $sqlFields);
			$sql .= ' FROM ' . static::$table;
			static::$sqlQueries['query'] = $sql;
		}
		return static::$sqlQueries['query'];
	}

	public static function sqlQueryCount()
	{
		if (!array_key_exists('query-count', static::$sqlQueries)) {
			$sql = 'SELECT COUNT(1) FROM ' . static::$table;
			static::$sqlQueries['query-count'] = $sql;
		}
		return static::$sqlQueries['query-count'];
	}

	protected static function sqlQueryByPK()
	{
		if (!array_key_exists('by-pk', static::$sqlQueries)) {
			$sql = 'SELECT ';
			$sqlFields = array();
			foreach (static::pk() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			foreach (static::fields() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sql .= implode(',', $sqlFields);
			$sql .= ' FROM ' . static::$table;
			$sql .= ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pk() as $field => $cfg)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			static::$sqlQueries['by-pk'] = $sql;
		}
		return static::$sqlQueries['by-pk'];
	}
	protected static function sqlInsert()
	{
		if (!array_key_exists('insert', static::$sqlQueries)) {
			$sql = 'INSERT INTO ' . static::$table;
			$sqlFields = array();
			foreach (static::pk() as $field => $cfg)
				if ($cfg['type'] != 'int' || !$cfg['auto'])
					$sqlFields[] = static::wrapField($field);
			foreach (static::fields() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			if ($sqlFields)
				$sql .= '(' . implode(',', $sqlFields) . ')';
			$sql .= ' VALUES (';
			if ($sqlFields)
				$sql .= implode(',', array_fill(0, count($sqlFields), '?'));
			$sql .= ');';
			static::$sqlQueries['insert'] = $sql;
		}
		return static::$sqlQueries['insert'];
	}

	protected static function sqlUpdate($update_fields = null)
	{
		if (!array_key_exists('update', static::$sqlQueries)) {
			$sql = 'UPDATE ' . static::$table . ' SET ';
			$sqlFields = array();
			foreach (static::fields() as $field => $cfg) {
				if ($update_fields && !in_array($field, $update_fields)) {
					continue;
				}
				$sqlFields[] = static::wrapField($field) . '=?';
			}

			$sql .= implode(',', $sqlFields);
			$sql .= ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pk() as $field => $cfg)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			$sql .= ';';
			static::$sqlQueries['update'] = $sql;
		}
		return static::$sqlQueries['update'];
	}
	protected static function sqlDelete()
	{
		if (!array_key_exists('delete', static::$sqlQueries)) {
			$sql = 'DELETE FROM ' . static::$table . ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pk() as $field => $cfg)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			$sql .= ';';
			static::$sqlQueries['delete'] = $sql;
		}
		return static::$sqlQueries['delete'];
	}
	protected static function sqlQueryI18n()
	{
		if (!array_key_exists('query-i18n', static::$sqlQueries)) {
			$sql = 'SELECT ';
			$sqlFields = array();
			$sqlFields[] = 'IDLang';
			foreach (static::fieldsI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sql .= implode(',', $sqlFields);
			$sql .= ' FROM ' . static::$tableI18n;
			$sql .= ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pkI18n() as $field => $auto)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			$sql .= ';';
			static::$sqlQueries['query-i18n'] = $sql;
		}
		return static::$sqlQueries['query-i18n'];
	}
	protected static function sqlQueryI18nByLang()
	{
		if (!array_key_exists('query-i18n-by-lang', static::$sqlQueries)) {
			$sql = 'SELECT ';
			$sqlFields = array();
			foreach (static::fieldsI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sql .= implode(',', $sqlFields);
			$sql .= ' FROM ' . static::$tableI18n;
			$sql .= ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pkI18n() as $field => $auto)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sqlPrimaryFields[] = 'IDLang=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			$sql .= ';';
			static::$sqlQueries['query-i18n-by-lang'] = $sql;
		}
		return static::$sqlQueries['query-i18n-by-lang'];
	}

	protected static function sqlReplaceI18n()
	{
		if (!array_key_exists('replace-i18n', static::$sqlQueries)) {
			$sql = 'REPLACE INTO ' . static::$tableI18n;
			$sqlFields = array();
			foreach (static::pkI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sqlFields[] = 'IDLang';
			foreach (static::fieldsI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sql .= '(' . implode(',', $sqlFields) . ')';
			$sql .= ' VALUES ';
			$sql .= implode(',', array_fill(0, count(Lang::getList()), '(' . implode(',', array_fill(0, count($sqlFields), '?')) . ')'));
			$sql .= ';';
			static::$sqlQueries['replace-i18n'] = $sql;
		}
		return static::$sqlQueries['replace-i18n'];
	}

	protected static function sqlInsertI18n()
	{
		if (!array_key_exists('insert-i18n', static::$sqlQueries)) {
			$sql = 'INSERT INTO ' . static::$tableI18n;
			$sqlFields = array();
			foreach (static::pkI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sqlFields[] = 'IDLang';
			foreach (static::fieldsI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field);
			$sql .= '(' . implode(',', $sqlFields) . ')';
			$sql .= ' VALUES ';
			$sql .= implode(',', array_fill(0, count(Lang::getList()), '(' . implode(',', array_fill(0, count($sqlFields), '?')) . ')'));
			$sql .= ';';
			static::$sqlQueries['insert-i18n'] = $sql;
		}
		return static::$sqlQueries['insert-i18n'];
	}

	protected static function sqlUpdateI18nByLang()
	{
		if (!array_key_exists('update-i18n-by-lang', static::$sqlQueries)) {
			$sql = 'UPDATE ' . static::$tableI18n . ' SET ';
			$sqlFields = array();
			foreach (static::fieldsI18n() as $field => $cfg)
				$sqlFields[] = static::wrapField($field) . '=?';
			$sql .= implode(',', $sqlFields);
			$sql .= ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pkI18n() as $field => $cfg)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sqlPrimaryFields[] = 'IDLang=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			$sql .= ';';
			static::$sqlQueries['update-i18n-by-lang'] = $sql;
		}
		return static::$sqlQueries['update-i18n-by-lang'];
	}

	protected static function sqlDeleteI18n()
	{
		if (!array_key_exists('delete-i18n', static::$sqlQueries)) {
			$sql = 'DELETE FROM ' . static::$tableI18n . ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pkI18n() as $field => $cfg)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			static::$sqlQueries['delete-i18n'] = $sql;
		}
		return static::$sqlQueries['delete-i18n'];
	}

	protected static function sqlDeleteI18nByLang()
	{
		if (!array_key_exists('delete-i18n-by-lang', static::$sqlQueries)) {
			$sql = 'DELETE FROM ' . static::$tableI18n . ' WHERE ';
			$sqlPrimaryFields = array();
			foreach (static::pkI18n() as $field => $cfg)
				$sqlPrimaryFields[] = static::wrapField($field) . '=?';
			$sqlPrimaryFields[] = 'IDLang=?';
			$sql .= implode(' AND ', $sqlPrimaryFields);
			$sql .= ';';
			static::$sqlQueries['delete-i18n-by-lang'] = $sql;
		}
		return static::$sqlQueries['delete-i18n-by-lang'];
	}

	// Tools
	protected static function currentDateIfNan($value)
	{
		if (strtotime($value))
			return $value;
		return date('Y-m-d');
	}


	protected static function currentDatetimeIfNan($value)
	{
		if (strtotime($value))
			return $value;
		return date('Y-m-d H:i:s');
	}

	function __get($name)
	{
		return $this->get($name);
	}

	function __set($name, $value)
	{
		return $this->set($name, $value);;
	}

	function getArray($field, $seperator = false, $asio = false)
	{
		if (!$this->get($field)) {
			return [];
		}

		if ($seperator) {
			return explode(',', $this->get($field));
		}
		return json_decode($this->get($field), $asio);
	}

	function setJson($field, $value, $seperator =  false)
	{
		if (!is_null($value)) {
			$value  = $seperator ? implode(',', $value) : json_encode($value);
		}

		return $this->set($field, $value);
	}


	function getJsonProperty($field, $property = '')
	{
		if (!$this->get($field)) {
			return [];
		}
		$return = json_decode($this->get($field), true);
		$property = explode(".", $property);
		foreach ($property  as $key) {
			if (isset($return[$key])) {
				$return = $return[$key];
			}
		}
		return $return;
	}

	public function asArray()
	{
		return $this->attrs;
	}

	function updateData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->set($key, $value);
		}
		$this->save();
		return $this;
	}

	function add($model, $data = array())
	{
		$etd = new $model();
		foreach ($data as $key => $value) {
			$etd->set($key, $value);
		}
		$etd->save();
		return $etd;
	}

	function getMany($model, $field)
	{
		$list  =  $model::getList(array('where' => array($field => $this->get('ID'))));
		return $list;
	}

	public  function fill($data)
	{
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$this->setJson($key, $value);
			} else {
				$this->set($key, $value);
			}
		}
	}

	public static function create($data)
	{
		$oject =  new static();
		foreach ($data as $key => $value) {
			$oject->set($key, $value);
		}
		$oject->save();
		return $oject;
	}

	public static function createObject($attrs)
	{
		$obj = 	new static();
		$obj->load($attrs);
		return $obj;
	}
}
