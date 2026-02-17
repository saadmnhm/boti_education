<?php


function mailContact($subject, $message, $admin)
{
	loadLib('sendgrid');

	$subject = $subject ? $subject : 'Nouveau message';
	$email = new \SendGrid\Email();

	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($admin, $admin)
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Contact');

	Mail::send($email);
}



function mailNouvelleTacheToAdmin($tache, $names, $admin)
{
	loadLib('sendgrid');

	$email = new \SendGrid\Email();


	$subject = "Nouvelle tâche - MCG Team";
	$message = "Une nouvelle tâche a été affectée à " . $names;
	$message .= " par " . $tache->get('User')->getNomComplet();
	$message .= " avec date butoir \"" . (\Tools::dateFormat($tache->get('DateFin'))) . "\" <br>";
	$message .= "Vous pouvez consuter son état sur ";
	$message .= "<a href=\"" . (URL::admin('taches/view/' . $tache->get('ID'))) . "\">votre espace  ICI</a>";

	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($admin->get('Email'), $admin->getNomComplet())
		// ->addSmtpapiTo('imane.boute@gmail.com', 'Imane BOUTE')
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Tache');

	Mail::send($email);
}

function mailReportToAdmin($admin, $message)
{
	loadLib('sendgrid');

	$email = new \SendGrid\Email();


	$subject = "Rapport de tâches de la semaine - MCG Team";

	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($admin->get('Email'), $admin->getNomComplet())
		// ->addSmtpapiTo('imane.boute@gmail.com', 'Imane BOUTE')
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Tache');
	Mail::send($email);
}



function mailPV($to, $subject, $message)
{
	loadLib('sendgrid');

	$email = new \SendGrid\Email();
	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($to->get('Email'), $to->getNomComplet())
		// ->addSmtpapiTo('imane.boute@gmail.com', 'Imane BOUTE')
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Tache');
	Mail::send($email);
}


function mailNouvelleTacheToCollaborateur($user, $tache)
{
	loadLib('sendgrid');

	$email = new \SendGrid\Email();


	$subject = "Nouvelle tâche - MCG Team";
	$message = "Bonjour <b>" . $user->get('Prenom') . "</b>, <br>";
	$message .= "Une nouvelle tâche vous a été affectée par " . $tache->get('User')->getNomComplet();
	$message .= " avec date d’échéance de : \"" . (\Tools::dateFormat($tache->get('DateFin'))) . "\" <br>";
	$message .= "<b>" . $tache->get('Label') . "</b> <br>";
	$message .= $tache->get('Content') . " <br>";
	$message .= "Vous pouvez consulter vos tâches sur votre espace Web <a href=\"" . (URL::admin()) . "\">votre espace  ICI</a>";

	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($user->get('Email'), $user->getNomComplet())
		// ->addSmtpapiTo('imane.boute@gmail.com', 'Imane BOUTE')
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Tache-Collaborateur');

	Mail::send($email);
}


function mailEtatToAdmin()
{
	loadLib('sendgrid');

	$email = new \SendGrid\Email();

	$subject = "Rapport de tâches de la semaine - MCG Team";

	$taches = Models\Tache::getList(array('where' => array('Etat NOT IN (2,5)')));
	$message = '';
	$message .= "Bonjour, <br>";
	$message .= "<b>" . count($taches) . "</b> nouvelles tâches <br><br>";
	$message .= "<b>" . count($taches) . "</b> tâches en cours <br>";

	$message .= "<table>";
	$message .= "<thead>
					<tr style='border:1px solid black;'>
						<th style='border:1px solid black;'>Tâche</th>
						<th style='border:1px solid black;'>Etat</th>
						<th style='border:1px solid black;'>Date Ajout</th>
						<th style='border:1px solid black;'>Date Echéance</th>
						<th style='border:1px solid black;'>Remarque</th>
						<th style='border:1px solid black;'>Nombre d’échanges</th>
					</tr>
				</thead>";
	$message .= "<tbody>";
	foreach ($taches as $tache) {
		$comments = $tache->commentaires();
		$count_comments = count($comments);

		$message .= "<tr style='border:1px solid black;'><td style='border:1px solid black;'>" . $tache->get('Label') . "</td>";
		$message .= "<td style='border:1px solid black;' >";
		$message .= ($tache->get('Etat') ? $tache->get('Etat')->get('Label') : '---') . "</td>";
		$message .= "<td style='border:1px solid black;'>" . \Tools::dateformat($tache->get('Date')) . "</td>";
		$message .= "<td style='border:1px solid black;'>" . \Tools::dateformat($tache->get('DateFin')) . "</td>";
		$message .= "<td style='border:1px solid black;'>" . $count_comments > 0 ? $comments[$count_comments - 1]->get('Commentaire') : '---' . "</td>";
		$message .= "<td style='border:1px solid black;'>" . $count_comments . "</td></tr>";
	}
	$message .= "</tbody>";
	$message .= "</table>";

	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		// ->addSmtpapiTo($admin, $admin)
		->addSmtpapiTo('imane.boute@gmail.com', 'Imane BOUTE')
		->addSmtpapiTo('a.semoud@gmail.com', 'Ahmed SEMOUD')
		->addSmtpapiTo('bahsani@megacompetences.ma', 'Samir BAHSANI')
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Contact');

	Mail::send($email);
}

function mailNouvelleTache($subject, $message, $admin)
{
	loadLib('sendgrid');

	$email = new \SendGrid\Email();

	$email
		// Template de l'email
		->setTemplateId('523a681e-fa74-489c-b10c-12b1aceef489') // crée sur le Dashboard SendGrid
		// ->setTemplateId('b7d3ba6b-6149-4a4d-9ea9-b2ca54ca83cc') // crée sur le Dashboard SendGrid
		->addFilter('bypass_list_management', 'enabled', 1) // Only for important messages !! like password resets
		// To
		->addSmtpapiTo($admin, $admin)
		// From
		->setFrom('noreply@mcg-team.com')
		->setFromName('MCG Team')
		->setReplyTo('contact@mcg-team.com')
		// Content, vide si une template est utilisé, le contenu sera remplacé par les variables ci-dessous
		->setSubject($subject)
		->setText(' ')
		->setHtml(' ')
		// Variables
		->addSubstitution("%message%", array($message))
		->addUniqueArg('ClientID', date('Y-m-d H:i:s'))
		->addCategory('SYS-MCG-Contact');

	Mail::send($email);
}
