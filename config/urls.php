<?php
return array(
	'ajax' => 'ajax',
	'login' => 'login',
	'upload-editor' => 'upload-editor',
	'home' => 'home',
	'press' => 'press',
	"press/([a-z0-9-]+)" => 'press/detail/$1',
	'publications' => 'publication',
	"publications/([a-z0-9-]+)" => 'publication/detail/$1',
	'school-life' => 'schoollife',
	
	'contact' => 'contact',
	'inscription' => 'inscription',
	'blog' => 'blog',
	'mot-de-directrice' => 'directrice',
	'galerie' => 'blog/media',
	'confidentialite' => 'blog/article/$0',
	'blog/([a-z0-9-]+)' => 'blog/article/$1',
	'approche-pedagogique' => 'posts/approche',

	// 'parameters/([a-z0-9-]+)' => 'parameters/$1',
	// 'parameters/([a-z0-9-]+)/([a-z0-9-]+)' => 'parameters/$1/$2',

);

