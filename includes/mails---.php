<?php
$css = 'body{color:#333;font-family:\'Segoe UI\', Arial, sans-serif;max-width:600px;font-size:13px} h1,h2,h3{font-size: 14px; font-weight: bold; color: #010101;} h1{font-size:1.6em;} h3{font-size:1.3em;} ul{list-style:none;padding-left:15px;} a{color:#66C;text-decoration:none} a:hover{color:#339;text-decoration:underline}';

function mailTest() {
	global $css;

	$subject = 'Test Messagerie';

	$message  = '<html><head><meta charset="utf-8"><style>'.$css.'</style></head><body>';
	$message .= '<h1>Test</h1>';
	$message .= '<p><small>envoyé le '.Tools::dateFormat(new Datetime()).'</small></p>';
	$message .= '<h3>Info</h3>';
	$message .= '<p>Bonjour cet email est juste pour tester l\'envoi, ainsi que la réception, pour les emails envoyé<p>';
	$message .= '</body></html>';

	return myMail($subject, $message);
}

//*********************************************************** Envoi Mail
function myMail($subject, $message, $to=null) {
	global $depth;
	require_once 'includes/phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->XMailer = ' ';

	//$mail->SMTPDebug = 3;				// Enable verbose debug output

	$mail->isSMTP();							// Set mailer to use SMTP
	$mail->Host = Config::get('smtpHost');			// Specify main and backup SMTP servers
	$mail->Port = Config::get('smtpPort');				// TCP port to connect to
	$mail->Username = Config::get('smtpUsername');		// SMTP username
	$mail->Password = Config::get('smtpPassword');		// SMTP password
	$mail->SMTPAuth = true;						// Enable SMTP authentication
	$mail->SMTPSecure = 'tls';					// Enable TLS encryption, `ssl` also accepted

	$fromEm=Config::get('fromEmail');

	if (is_array($fromEm)) {

		if (array_key_exists('email', $fromEm))
			$mail->From = $fromEm['email'];
		if (array_key_exists('name', $fromEm))
			$mail->FromName = $fromEm['name'];
	}
	else
		$mail->From = Config::get('fromEmail');

	if (!$to)
		$to = Config::get('adminEmail');
	if (is_array($to)) {
		foreach ($to as $k => $v) {
			if (is_array($v))
				if (array_key_exists('email', $v))
					if (array_key_exists('name', $v))
						$mail->addAddress($v['email'], $v['name']);
					else
						$mail->addAddress($v['email']);
			else
				$mail->addAddress($v);
		}
		if (array_key_exists('email', $to))
			if (array_key_exists('name', $to))
				$mail->addAddress($to['email'], $to['name']);
			else
				$mail->addAddress($to['email']);
	}
	else
		$mail->addAddress($to);

	$mail->WordWrap = 120;
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';

	$mail->Subject = $subject;
	$mail->Body = $message;

	$sent = $mail->send();

	if (!$sent) {
		echo 'Mail Error: '. $mail->ErrorInfo;
	}
	return $sent;
}
function mailInscriptionToUser($inscription){
	global $css;
	$subject = 'Nouveau demande d\'inscription';
	$message  = '<html><head><meta charset="utf-8"><style>'.$css.'</style></head><body>';
	$message .= '<h3>Bonjour '.$inscription->get('Prenom').' '.strtoupper($inscription->get('Nom')).'</h3>';
	$message .= '<p>Félicitations! Nous avons l’honneur de vous informer  que votre demande d’inscription a bien été enregistrée sur le portail assuré du site web <b><a href="www.eheb.ma" target="_blank">www.eheb.ma</a>.</b></p>';
	$message .= '<p>Votre demande sera traitée dans les plus brefs délais.</p>';
	$message .= '<p>Nous serons à votre disposition pour toute information supplémentaire.</p>';
	$message .= '<p>Cordialement.</p>';
	$message .= '</body></html>';

	return myMail($subject, $message, $inscription->get('Email'));
}
function mailInscriptionToAdmin($inscription){
	global $css;
	$subject = "Nouveau message";
	$message  = '<html><head><meta charset="utf-8"><style>'.$css.'</style></head><body>';
	$message .= '<p>Nous vous informons qu’un nouvelle demande d\'inscription a été enregistré sur le site web.</p>';
	$message .= '<p><b><a href='.URL::absolute(URL::admin('inscriptions/view/'.$inscription->get('ID'))).'>Lien</a></b></p>';
	$message .= '<p>Cordialement.</p>';
	$message .= '</body></html>';
	return myMail($subject, $message);
}
function mailContact($contact){
	global $css;
	$subject = "Nouveau message";
	$message  = '<html><head><meta charset="utf-8"><style>'.$css.'</style></head><body>';
	$message .= '<p>Nous vous informons qu’un nouveau message a été enregistré sur le site web.</p>';
	$message .= '<p>Il s’agit d’un message de <b>'.$contact->get('Nom').'</b></p>';
	$message .= '<p><b><a href='.URL::absolute(URL::admin('contacts/view/'.$contact->get('ID'))).'>Lien</a></b></p>';
	$message .= '<p>Cordialement.</p>';
	$message .= '</body></html>';
	return myMail($subject, $message);
}