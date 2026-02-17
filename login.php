<?php
if(isset($_GET['connect'])){
	\Session::getInstance()->setCurUser(new Models\User(20));
	return URL::redirect(URL::admin());
}
// Post
use Models\Connexion;
use Models\User;
if (isset($_POST['op'])) {
	switch ($_POST['op']) {
		case 'login':					
			
			if (isset($_POST['login']) && isset($_POST['password'])) {

				$user = User::auth($_POST['login'], $_POST['password']);
				if ($user) {
					if(!$user->get('Enabled')){
						$_SESSION['loginerror'] = 'Compte bloqué.';
						URL::redirect(URL::link('login'));
					}

					Session::getInstance()->setCurUser($user);
					// ???
					Connexion::addEntry($user , 'Desktop App');
					Config::set('admin', 'admin');

					//if ($user->get('Role')->get('Alias') == 'admin') {
					//	Config::set('admin', 'admin');
					//}
					//elseif ($user->get('Role')->get('Alias') == 'collaborateur') {
					//	Config::set('admin', 'gerant');
					//}
				   // $user->set('Fingerprint', strip_tags($_POST['fg_profile_sh']))->save();

					$user->save();
					$_SESSION['fg_profile_sh'] = strip_tags($_POST['fg_profile_sh']);

					URL::redirect(URL::admin());
				}
				else {
					$_SESSION['loginerror'] = 'L\'adresse e-mail ou le mot de passe que vous avez entré n\'est pas valide.';
					URL::redirect(URL::link('login'));
				}
			}
	}
}

if (isset($_GET['logout'])) {
	Session::getInstance()->unsetCurUser();
	URL::redirect(URL::link('login'));
}

$errorLogin = null;

if (isset($_SESSION['loginerror'])) {
	$errorLogin =  $_SESSION['loginerror'];
	unset($_SESSION['loginerror']);
}

loadView('login', array(
		'navKey' => 'login',
		'errorLogin' =>	$errorLogin
),'layout-login');

