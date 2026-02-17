<?php


function mailContact($contact, $admin) {
	loadLib('sendgrid');

	$email = new \SendGrid\Email();

	$email
		// Template de l'email
		->setTemplateId('97bbde65-ec12-4cec-a280-f42440b5b5a0') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($admin, $admin)
		// From
		->setFrom('marketing@eheb.ma')
		->setFromName('EHEB.ma')
		->setReplyTo('marketing@eheb.ma')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject('Nouveau message')
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%nom%", array($contact->get('Nom')))	
		->addSubstitution("%telephone%", array($contact->get('Telephone')))	
		->addSubstitution("%sujet%", array($contact->get('Sujet')))	
		->addSubstitution("%message%", array($contact->get('Message')))	
		->addSubstitution("%lien%", array(URL::absolute(URL::admin('contacts/view/'.$contact->get('ID')))))	
		->addUniqueArg('ClientID', $contact->get('ID'))
		->addCategory('SYS-EHEB-Contact')
		;

	Mail::send($email);
}

function mailInscriptionToUser($inscription) {
	loadLib('sendgrid');

	$email = new \SendGrid\Email();

	$email
		// Template de l'email
		->setTemplateId('ba0fd0a8-e38f-4ca2-b4fc-55d4227a1482') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($inscription->get('Email'), $inscription->get('Email'))
		// From
		->setFrom('marketing@eheb.ma')
		->setFromName('EHEB.ma')
		->setReplyTo('marketing@eheb.ma')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject('EHEB : Demande d\'inscription')
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%nom%", array($inscription->get('Prenom').' '.strtoupper($inscription->get('Nom'))))	
		->addUniqueArg('ClientID', $inscription->get('ID'))
		->addCategory('SYS-EHEB-InscriptionUser')
		;

	Mail::send($email);
}

function mailInscriptionToAdmin($inscription, $admin) {
	loadLib('sendgrid');

	$email = new \SendGrid\Email();
	
	
	$infos = '';
	$infos .= '<li><b>Nom</b> : '.$inscription->get('Nom').'</li>';
	$infos .= '<li><b>Prénom</b> : '.$inscription->get('Prenom').'</li>';
	$infos .= '<li><b>Date naissance</b> : '.$inscription->get('DateNaissance').'</li>';
	$infos .= '<li><b>Adresse</b> : '.$inscription->get('Adresse').'</li>';
	$infos .= '<li><b>Email</b> : '.$inscription->get('Email').'</li>';
	$infos .= '<li><b>GSM</b> : '.$inscription->get('TelProtable').'</li>';
	$infos .= '<li><b>Type de bac</b> : '.$inscription->get('TypeBac').'</li>';
	$infos .= '<li><b>Année du Bac</b> : '.$inscription->get('AnneeBac').'</li>';
	$infos .= '<li><b>Niveau et Diplôme</b> : '.$inscription->get('Niveau').'</li>';
	$infos .= '<li><b>Comment avez-vous connu l\'EHEB </b> : '.$inscription->get('Connaissance').'</li>';
	$infos .= '<li><b>Motivation</b> : '.$inscription->get('Avis').'</li>';

	
	$files = json_decode($inscription->get('Files'));
	for($i=0; $i<count($files); $i++){
		$email->addAttachment(Models\Inscription::getJsonFileAbsolute($files[$i]));
	}
	
	$email
		// Template de l'email
		->setTemplateId('c10e8e9b-74ec-4e7f-bcbf-67238504e698') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($admin, $admin)
		// From
		->setFrom('marketing@eheb.ma')
		->setFromName('EHEB.ma')
		->setReplyTo('marketing@eheb.ma')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject('EHEB : Nouvelle Demande d\'inscription')
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%lien%", array(URL::absolute(URL::admin('inscriptions/view/'.$inscription->get('ID')))))	
		->addSubstitution("%infos%", array($infos))	
		->addUniqueArg('ClientID', $inscription->get('ID'))
		->addCategory('SYS-EHEB-InscriptionAdmin')
		;

	Mail::send($email);
}