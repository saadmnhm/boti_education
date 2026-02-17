<?php
namespace Models;

class Connexion extends Model {

	protected static $sqlQueries = array();

	protected static $table = 'connexions';
	protected static $pk = array(
		'ID' => array(
			'auto' => true,
		),
	);
	protected static $fields = array(
		'User' => array(
			'fk' => 'User',
		),
		'Date' => array(
			'type' => 'datetime',
		),
		'Client' => array(
			'type' => 'varchar',
		),
		'Source' => array(
			'type' => 'varchar',
		),
		'Device' => array(
			'type' => 'varchar',
		),
		'Navigateur' => array(
			'type' => 'varchar',
		),
	);
	
	public static function getBrowser() 
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'pattern'    => $pattern
		);
	} 		public static function addEntry($user, $source, $api = null) {				if (!$user)			return NULL;		
		if($api) {
						$logs = Connexion::getCount(array('where' => array(
				'DATE(Date) = CURDATE()',				'User' => $user->get('ID'),			)));						if($logs > 0)				return NULL;
		}
		
				
		$ua = Connexion::getBrowser();
		// $yourbrowser = $ua['name'] . " " . $ua['version'];
		$yourbrowser = $ua['name'];
		
		$detect = new \MobileDetect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');				$log = new Connexion();			$log->set('User', $user)				->set('Client', $_SERVER['REMOTE_ADDR'])
				->set('Device', $deviceType)
				->set('Navigateur', $yourbrowser)				->set('Date',  date('Y-m-d H:i:s'))				->set('Source',  $source)				->save();		return $log;	}

		/*
		
		*/



}
