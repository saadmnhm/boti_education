<?php
class Mail {

	private $loggedIn = null;
	private $sendgrid = null;

	// Singletone Implementation
	public static function getInstance() {
		static $instance = null;
		if ($instance === null) {
			$instance = new self();
			$instance->sendgrid = new \SendGrid(Config::get('api-keys-sendgrid-mail'));
		}
		return $instance;
	}

	public static function send($email) {
		return static::getInstance()->sendgrid->send($email);
	}
}

/* Example

$email = new SendGrid\Email();

$email
	// Template de l'email
	->setTemplateId('123456789-abcd-12ab-ab12-1234567890ab') // crée sur le Dashboard SendGrid
	// ->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
	// To
	->addSmtpapiTo('a.digourdi@gmail.com', 'Abderrahim Digourdi')
	->addSmtpapiTo('a.semoud@sysartech.com', 'Ahmed Semoud')
	// From
    ->setFrom('noreply@domain.com')
	->setFromName('domain.com')
	->setReplyTo('contact@comain.com')
	// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
	->setSubject(' ')
	->setText(' ')
	->setHtml(' ')
	// Variables
	->addSubstitution("%firstname%", array('Abderrahim', 'Ahmed'))
	->addSubstitution("%lastname%", array('Digourdi', 'Semoud'))
	->addSubstitution("%fullname%", array('Abderrahim Digourdi', 'Ahmed Semoud'))
	// Tracking
	->addUniqueArg('ClientID', '116-273')
	// ->addCategory('SYS-Reservation')
    // ->addCategory('SYS-NewClient')
	// ->addCategory('SYS-Reservation-Rappel')
	;

Mail::send($email);
//*/
