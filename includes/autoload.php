<?php
abstract class Autoload {
	private static $locations = array();

	public static function load($classname) {
		$classname = strtolower($classname);
		$classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
		foreach (self::$locations as $location)
			if (is_readable($location.$classname.'.php')) {
				require $location.$classname.'.php';
				return true;
			}
		// errorlog('Class '.$classname.' could not be loaded');
	}

	public static function registerLocation($location) {
		if (!file_exists($location) || !is_dir($location))
			throw new Exception('Directory not found');
		self::$locations[] = $location; // Append to queue
		// array_splice(self::$locations, 0, 0, $location); // Insert in first position
	}
}

spl_autoload_register('Autoload::load', true, true);

Autoload::registerLocation(_basepath.'classes/');
