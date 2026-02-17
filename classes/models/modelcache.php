<?php

namespace Models;


class ModelCache
{

	protected static $caches =  null;

	public static function set($model, $key, $record)
	{
		static::$caches[$model][(is_array($key) ? implode("_", $key) : $key)] = $record;
		return;
	}

	public static function get($model, $key)
	{
		return static::$caches[$model][$key] ?? null;
	}

	public static function remove($model, $key)
	{
		unset(static::$caches[$model][$key]);
	}

	public static function getAllCaches()
	{
		return static::$caches;
	}
}
