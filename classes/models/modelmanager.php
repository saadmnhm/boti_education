<?php

namespace Models;

use Request;

class ModelManager
{
	protected $query_where = array();
	protected $query_order = array();
	protected $query_groupBy = array();
	protected $limit =  null;
	protected $start =  null;
	protected $model =  null;
	protected $join_i =  1;
	protected $sql_query =  null;
	protected $eagerWith = [];

	function  __construct($model)
	{
		$this->model = $model;
	}

	function  where($where = null)
	{
		if (!is_null($where)) {
			if (is_array($where)) {
				foreach ($where as $key => $value) {
					$this->query_where[$key] = is_object($value) ? $value->getPk(true) : $value;
				}
			} else {
				if ($where)
					$this->query_where[] = $where;
			}
		}

		return $this;
	}

	function  whereInJson($field, $values)
	{
		$queries = [];
		if ($values) {
			foreach ($values as  $item) {
				$queries[] = ' (' . $field . '  LIKE \'%"' . $item . '"%\') ';
			}
			$this->query_where[] = "(" . implode(' OR ', $queries) . ")";
		}

		return $this;
	}

	function  whereNotInJson($field, $values)
	{
		$queries = [];
		if ($values) {
			foreach ($values as  $item) {
				$queries[] = ' (' . $field . ' NOT LIKE \'%"' . $item . '"%\') ';
			}
			$this->query_where[] = "(" . implode(' AND ', $queries) . ")";
		}

		return $this;
	}

	function  whereIn($field, $values)
	{

		if (!empty($values)) {
			$this->query_where[] = "(" .  $field . " IN(" . (is_array($values) ? implode(',', $values) : $values) . ")" . ")";;
		} else {
			$this->query_where[] = "(" . $field . " IN(0)" . ")";
		}


		return $this;
	}

	function or(...$querys)
	{
		$queries = [];
		$queries[] = "(";

		foreach ($querys as $key => $query_callback) {
			$manager = new self($this->model);
			$query = $query_callback($manager);
			if ($manager->getQuery()) {
				$query = $manager->getQuery();
				$queries[] = "( " . implode(" AND ", $query) . " )";
				$queries[] = " OR ";
			}
		}
		array_pop($queries);
		$queries[] = ")";
		$this->query_where[] = implode("", $queries);

		return $this;
	}

	function between($field, $v1, $v2)
	{
		$this->query_where[] =  '(`' . $field . '` BETWEEN \'' . $v1 . '\' AND \'' . $v2 . '\')';
		return $this;
	}


	function whereNull($field)
	{
		$this->query_where[] =  '(`' . $field . '` IS NULL )';
		return $this;
	}


	function whereNotNull($field)
	{
		$this->query_where[] =  '(`' . $field . '` IS NOT NULL )';
		return $this;
	}

	function whereNotIn($field, $values)
	{

		if (!empty($values)) {
			$this->query_where[] = $field . " NOT IN(" . (is_array($values) ? implode(',', $values) : $values) . ")";
		} else {
			$this->query_where[] = $field . " NOT IN(0)";
		}
		return $this;
	}

	function order($order = array())
	{
		foreach ($order as $key => $value) {
			$this->query_order[$key] = $value;
		}
		return $this;
	}


	function limit($limit)
	{
		$this->limit = $limit;
		return $this;
	}

	function start($start = 0)
	{
		$this->start = $start;
		return $this;
	}


	function join($query)
	{
		$this->sql_query .= ' ' . $query;

		return $this;
	}

	function get()
	{
		$list = $this->model::getList(array('where' => $this->query_where, 'order' => $this->query_order, 'limit' => $this->limit, 'groupBy' => $this->query_groupBy, 'start' => $this->start), $this->sql_query ? $this->model::sqlQuery(true) . $this->sql_query : null);
		$this->getListEager($list);
		return $list;
	}

	function all($cached = false)
	{
		if ($cached) {
			$list =  $this->model::allCashed(array('where' => $this->query_where, 'order' => $this->query_order, 'limit' => $this->limit, 'groupBy' => $this->query_groupBy, 'start' => $this->start), $this->sql_query ? $this->model::sqlQuery(true) . $this->sql_query : null);
			$this->getListEager($list);
			return $list;
		}

		return $this->model::all(array('where' => $this->query_where, 'order' => $this->query_order, 'limit' => $this->limit, 'groupBy' => $this->query_groupBy, 'start' => $this->start), $this->sql_query ? $this->model::sqlQuery(true) . $this->sql_query : null);
	}

	function first()
	{
		$objs = $this->limit(1)->get();
		return isset($objs[0]) ? $objs[0] : null;
	}

	function with(...$relationships)
	{

		foreach ($relationships as $relation) {
			$fields =  explode('.', $relation);
			$lastModel =  null;
			foreach ($fields as  $field) {
				$lastModel = $this->addEagerWith($relation, $field, $lastModel);
			}
		}

		return $this;
	}

	function addEagerWith($relation, $field, $model = null)
	{
		if (!$model) {
			$model = $this->model;
		}

		$modelsFileds = $model::fields();

		$fieldModel = $modelsFileds[$field]['fk'] ?? null;

		if (!$fieldModel) {
			return;
		}

		$fieldModel = __NAMESPACE__ . '\\' . $fieldModel;

		$this->eagerWith[$relation][$model] = ['field' => $field, 'model' => $fieldModel];

		return 	$fieldModel;
	}

	function getListEager($list)
	{
		foreach ($this->eagerWith as $relations) {
			$listEager  = $list;
			foreach ($relations as $field_model) {
				$listKeys = array_unique(array_map(function ($item) use ($field_model) {
					return "'" . $item->getPrimitive($field_model['field']) . "'";
				}, $listEager));

				$listEager = $field_model['model']::query()->whereIn(array_keys($field_model['model']::pk())[0], $listKeys)->all(true);;
			}
		}
	}

	function count()
	{
		return $this->model::getCount(array('where' => $this->query_where), $this->sql_query ? $this->model::sqlQueryCount() . $this->sql_query : null);
	}

	public function getQuery()
	{
		$conditions = [];
		foreach ($this->query_where as $k => $v) {
			if (!is_numeric($k)) {
				if ($v === null)
					continue;
				$conditions[] = '`' . $k . '` = ' . $v;
			} else {
				$conditions[] = $v;
			}
		}
		return $conditions;
	}

	function groupBy($groupBy)
	{
		foreach ($groupBy as $value) {
			$this->query_groupBy[] = $value;
		}
		return $this;
	}

	function paginate($per_page = 10)
	{
		$page = Request::get('page') ?: 1;
		return $this->start($per_page * ($page - 1))->limit($per_page);
	}
}
