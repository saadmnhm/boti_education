<?php

return array(



	// Dev

	'dbserver' => 'localhost',

	'db' => 'boti_ed',

	'dbuser' => 'root',

	'dbpass' => '',


	//* Prod
	//'dbserver' => 'localhost',
	//	'db' => 'mcgteam_mcg',
	//	'dbuser' => 'mcgteam', 
	//	'dbpass' => 'dOYq1RwgQXZ6',
	//*/


	'admin' => 'admin',
	'role' => null,

	'extranet' => '',

	'default_path_collaborateurs' => 'taches',

	'display-errors' => true,



	// App settings

	'videoAutoPlay' => false,  // Autoplay videos



	// Emails

	'smtpHost' => '',

	'smtpPort' => 587,

	'smtpUsername' => '',

	'smtpPassword' => '',

	'fromEmail' => array('email' => '', 'name' => ''),

	'adminEmail' => array(

		array('email' => '', 'name' => ''),

	),



	'format-date' => '%d %b %Y',

	'format-date-recrut' => '%d <span>%b<span>',

	'format-dateinput' => '%Y-%m-%d',

	'format-time' => '%Hh%M',

	'format-timeinput' => '%H:%M',

	'format-datetime' => '%d %b %Y, %Hh%M',

	'format-datetimeinput' => '%Y-%m-%d %H:%M',

	'format-datetimeline' => '%d %b %Y %H:%M',



	'path-uploads' => 'assets/files/',

	'path-images' => 'assets/img/',

	'path-images-users' => 'assets/img/users/',

	'path-images-posts' => 'assets/img/posts/',

	'path-images-articles' => 'assets/img/articles/',

	'path-logo-etablissements' => 'assets/img/etablissements/',

	'path-files-img' => 'uploads/img/',

	'path-files-pointeurs' => 'uploads/pointeurs/',

	'path-files-inscription' => 'assets/site/uploads/files/',

	'path-files-documents' => 'assets/site/uploads/documents/',

	'path-icone-typepermission' =>  'assets/img/typepermission/',

	'path-icone-typetache' =>  'assets/img/typetache/',







	'upload-file-max-size' => 25,

	'upload-file-exts' => array('jpg', 'jpeg', 'gif', 'png', 'doc', 'docx', 'pdf', 'txt'),

	'upload-file-image-max-size' => 5,

	'upload-file-image-exts' => array('jpg', 'jpeg', 'gif', 'png', 'svg'),



	'api-keys-sendgrid-mail' => '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',
	



	// Attention de ne jamais modifier Les hash

	'hashchars' => '0123456789abcdefghijklmnopqrstuvwxyz',

	'hashsecretkey' => 'Mcdo',

	'hashlength' => 8,





);
