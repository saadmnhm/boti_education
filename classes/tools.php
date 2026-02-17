<?php
abstract class Tools {

	public static function nullCheck($var, $class=null, $returnID=false) {
		if ($class)
			if ($var instanceof $class)
				if ($returnID) return $var->getID();
				else return $var;
			else return null;
		elseif (!empty($var)) return $var;
		else return null;
	}

	public static function getAlias($txt) {
		// tableau des caractères spéciaux
		$chars = array('ъ'=>'-','Ь'=>'-','Ъ'=>'-','ь'=>'-','Ă'=>'A','Ą'=>'A','À'=>'A','Ã'=>'A','Á'=>'A','Æ'=>'A','Â'=>'A','Å'=>'A','Ä'=>'Ae','Þ'=>'B','Ć'=>'C','ץ'=>'C','Ç'=>'C','È'=>'E','Ę'=>'E','É'=>'E','Ë'=>'E','Ê'=>'E','Ğ'=>'G','İ'=>'I','Ï'=>'I','Î'=>'I','Í'=>'I','Ì'=>'I','Ł'=>'L','Ñ'=>'N','Ń'=>'N','Ø'=>'O','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'Oe','Ş'=>'S','Ś'=>'S','Ș'=>'S','Š'=>'S','Ț'=>'T','Ù'=>'U','Û'=>'U','Ú'=>'U','Ü'=>'Ue','Ý'=>'Y','Ź'=>'Z','Ž'=>'Z','Ż'=>'Z','â'=>'a','ǎ'=>'a','ą'=>'a','á'=>'a','ă'=>'a','ã'=>'a','Ǎ'=>'a','а'=>'a','А'=>'a','å'=>'a','à'=>'a','א'=>'a','Ǻ'=>'a','Ā'=>'a','ǻ'=>'a','ā'=>'a','ä'=>'ae','æ'=>'ae','Ǽ'=>'ae','ǽ'=>'ae','б'=>'b','ב'=>'b','Б'=>'b','þ'=>'b','ĉ'=>'c','Ĉ'=>'c','Ċ'=>'c','ć'=>'c','ç'=>'c','ц'=>'c','צ'=>'c','ċ'=>'c','Ц'=>'c','Č'=>'c','č'=>'c','Ч'=>'ch','ч'=>'ch','ד'=>'d','ď'=>'d','Đ'=>'d','Ď'=>'d','đ'=>'d','д'=>'d','Д'=>'d','ð'=>'d','є'=>'e','ע'=>'e','е'=>'e','Е'=>'e','Ə'=>'e','ę'=>'e','ĕ'=>'e','ē'=>'e','Ē'=>'e','Ė'=>'e','ė'=>'e','ě'=>'e','Ě'=>'e','Є'=>'e','Ĕ'=>'e','ê'=>'e','ə'=>'e','è'=>'e','ë'=>'e','é'=>'e','ф'=>'f','ƒ'=>'f','Ф'=>'f','ġ'=>'g','Ģ'=>'g','Ġ'=>'g','Ĝ'=>'g','Г'=>'g','г'=>'g','ĝ'=>'g','ğ'=>'g','ג'=>'g','Ґ'=>'g','ґ'=>'g','ģ'=>'g','ח'=>'h','ħ'=>'h','Х'=>'h','Ħ'=>'h','Ĥ'=>'h','ĥ'=>'h','х'=>'h','ה'=>'h','î'=>'i','ï'=>'i','í'=>'i','ì'=>'i','į'=>'i','ĭ'=>'i','ı'=>'i','Ĭ'=>'i','И'=>'i','ĩ'=>'i','ǐ'=>'i','Ĩ'=>'i','Ǐ'=>'i','и'=>'i','Į'=>'i','י'=>'i','Ї'=>'i','Ī'=>'i','І'=>'i','ї'=>'i','і'=>'i','ī'=>'i','ĳ'=>'ij','Ĳ'=>'ij','й'=>'j','Й'=>'j','Ĵ'=>'j','ĵ'=>'j','я'=>'ja','Я'=>'ja','Э'=>'je','э'=>'je','ё'=>'jo','Ё'=>'jo','ю'=>'ju','Ю'=>'ju','ĸ'=>'k','כ'=>'k','Ķ'=>'k','К'=>'k','к'=>'k','ķ'=>'k','ך'=>'k','Ŀ'=>'l','ŀ'=>'l','Л'=>'l','ł'=>'l','ļ'=>'l','ĺ'=>'l','Ĺ'=>'l','Ļ'=>'l','л'=>'l','Ľ'=>'l','ľ'=>'l','ל'=>'l','מ'=>'m','М'=>'m','ם'=>'m','м'=>'m','ñ'=>'n','н'=>'n','Ņ'=>'n','ן'=>'n','ŋ'=>'n','נ'=>'n','Н'=>'n','ń'=>'n','Ŋ'=>'n','ņ'=>'n','ŉ'=>'n','Ň'=>'n','ň'=>'n','о'=>'o','О'=>'o','ő'=>'o','õ'=>'o','ô'=>'o','Ő'=>'o','ŏ'=>'o','Ŏ'=>'o','Ō'=>'o','ō'=>'o','ø'=>'o','ǿ'=>'o','ǒ'=>'o','ò'=>'o','Ǿ'=>'o','Ǒ'=>'o','ơ'=>'o','ó'=>'o','Ơ'=>'o','œ'=>'oe','Œ'=>'oe','ö'=>'oe','פ'=>'p','ף'=>'p','п'=>'p','П'=>'p','ק'=>'q','ŕ'=>'r','ř'=>'r','Ř'=>'r','ŗ'=>'r','Ŗ'=>'r','ר'=>'r','Ŕ'=>'r','Р'=>'r','р'=>'r','ș'=>'s','с'=>'s','Ŝ'=>'s','š'=>'s','ś'=>'s','ס'=>'s','ş'=>'s','С'=>'s','ŝ'=>'s','Щ'=>'sch','щ'=>'sch','ш'=>'sh','Ш'=>'sh','ß'=>'ss','т'=>'t','ט'=>'t','ŧ'=>'t','ת'=>'t','ť'=>'t','ţ'=>'t','Ţ'=>'t','Т'=>'t','ț'=>'t','Ŧ'=>'t','Ť'=>'t','™'=>'tm','ū'=>'u','у'=>'u','Ũ'=>'u','ũ'=>'u','Ư'=>'u','ư'=>'u','Ū'=>'u','Ǔ'=>'u','ų'=>'u','Ų'=>'u','ŭ'=>'u','Ŭ'=>'u','Ů'=>'u','ů'=>'u','ű'=>'u','Ű'=>'u','Ǖ'=>'u','ǔ'=>'u','Ǜ'=>'u','ù'=>'u','ú'=>'u','û'=>'u','У'=>'u','ǚ'=>'u','ǜ'=>'u','Ǚ'=>'u','Ǘ'=>'u','ǖ'=>'u','ǘ'=>'u','ü'=>'ue','в'=>'v','ו'=>'v','В'=>'v','ש'=>'w','ŵ'=>'w','Ŵ'=>'w','ы'=>'y','ŷ'=>'y','ý'=>'y','ÿ'=>'y','Ÿ'=>'y','Ŷ'=>'y','Ы'=>'y','ž'=>'z','З'=>'z','з'=>'z','ź'=>'z','ז'=>'z','ż'=>'z','ſ'=>'z','Ж'=>'zh','ж'=>'zh');
		$txt = strtr($txt, $chars);
		$txt = mb_strtolower($txt, 'UTF-8'); // mettre le lien en miniscule
		// $txt = preg_replace('/[^a-z0-9]/', '-', $txt); // remplace tous les charactères non-valides
		//$txt = preg_replace('/[^a-z0-9~%.:_-]/', '-', $txt); // remplace tous les charactères non-valides
		$txt = preg_replace('/[^a-z0-9-]/', '-', $txt); // remplace tous les charactères non-valides (ELAZ)
		$txt = preg_replace('/-+/', '-', $txt); // élimininer les "-" doublants
		$txt = preg_replace('/(^-+)|(-+$)/', '', $txt); // supprimer les "-" en début et fin
		return $txt;
	}

	// Generate Random liste of charaters
	public static function randChars($length=10, $chars=null) {
		if (!$chars)
			$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$result = ''; $charslength = strlen($chars);
		for ($i=0; $i<$length; $i++)
			$result .= $chars{rand(0, $charslength-1)};
		return $result;
	}
	public static function getRandChars($length=10, $chars=null) {
		if (!$chars)
			$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$result = ''; $charslength = strlen($chars);
		for ($i=0; $i<$length; $i++)
			$result .= $chars{rand(0, $charslength-1)};
		return $result;
	}

	// Format Given Date to the given format
	public static function dateFormat($date, $format = '') {
		setlocale(LC_TIME, 'fr_FR', 'fr-FR', 'fra', 'french', 'fr');
		if ($date instanceof DateTime) $date = $date->getTimeStamp();
		if (getType($date) === 'string') $date = strtotime($date);
		if (!$format) $format = Config::get('format-date');
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return iconv('ISO-8859-1', 'UTF-8',strftime($format, $date));
		} else {
			return utf8_encode(strftime($format, $date));
		}
	}
	// Format Given Date to the given format
	public static function dateFormatAr($date) {
		$months = array(
			'01' => 'يناير',
			'02' => 'فبراير',
			'03' => 'مارس',
			'04' => 'أبريل',
			'05' => 'مايو',
			'06' => 'يونيو',
			'07' => 'يوليو',
			'08' => 'أغسطس',
			'09' => 'سبتمبر',
			'10' => 'أكتوبر',
			'11' => 'نوفمبر',
			'12' => 'ديسمبر'
		);
		
		$days = array(
			'1' => 'الإثنين',
			'2' => 'الثلاثاء',
			'3' => 'الأربعاء',
			'4' => 'الخميس',
			'5' => 'الجمعة',
			'6' => 'السبت',
			'7' => 'الأحد'
		);

		if ($date instanceof DateTime) $date = $date->getTimeStamp();
		if (getType($date) === 'string') $date = strtotime($date);

		// $date = new DateTime($date);
		return $days[\Tools::dateFormat($date, '%w')].' '.\Tools::dateFormat($date, '%d') . ' ' . $months[\Tools::dateFormat($date, '%m')] . ' ' . \Tools::dateFormat($date, '%Y %H:%M');
	}
	
	// Handling Numbers
	public static function numberClean($nbr, $decimals=2) {
		$nbr = 1 * str_ireplace(',', '.', $nbr);
		return round(number_format($nbr, $decimals, '.', ''), $decimals);
	}
	public static function numberFormat($nbr, $decimals=2) {
		return number_format($nbr, $decimals, ',', '.');
	}
	
	public static function datesListToRanges($datesList) {
		$ranges = array();
		$curRange = array();
		foreach ($datesList as $date) {
			$date = new Datetime(static::dateFormat($date, '%Y-%m-%d %H:%M:%S'));
			if (!$curRange)
				$curRange['start'] = $date;
			if (!isset($curRange['end'])) {
				$curRange['end'] = $date;
				continue;
			}
			$interval = $date->diff($curRange['end']);
			if ($interval->days > 1) {
				$ranges[] = $curRange;
				$curRange = array();
				$curRange['start'] = $date;
				$curRange['end'] = $date;
				continue;
			}
			else
				$curRange['end'] = $date;
		}
		$ranges[] = $curRange;
		return $ranges;
	}
	public static function dateRangeToHumanReadable($dateRange) {
		$startDate = $dateRange['start'];
		$endDate = $dateRange['end'];

		if ($startDate->getTimestamp() >= $endDate->getTimestamp())
			return static::dateFormat($startDate);

		$startYear = static::dateFormat($startDate, '%Y');
		$endYear = static::dateFormat($endDate, '%Y');

		if ($endYear != $startYear)
			return static::dateFormat($startDate, '%d %b %Y').' au '.static::dateFormat($endDate, '%d %b %Y');

		$startMonth = static::dateFormat($startDate, '%m');
		$endMonth = static::dateFormat($endDate, '%m');

		if ($startMonth != $endMonth)
			return static::dateFormat($startDate, '%d %b').' au '.static::dateFormat($endDate, '%d %b %Y');

		$interval = $endDate->diff($startDate);
		if ($interval->d > 2)
			return static::dateFormat($startDate, '%d').' au '.static::dateFormat($endDate, '%d %b %Y');
		if ($interval->d == 1)
			return static::dateFormat($startDate, '%d').' et '.static::dateFormat($endDate, '%d %b %Y');
		if ($interval->h > 1)
			return static::dateFormat($startDate, '%d %b %Y, %H:%M').' à '.static::dateFormat($endDate, '%H:%M');
		return static::dateFormat($startDate, '%d %b %Y, %H:%M');
	}

	/*
	Accepts:
		- 'value', 'replacement'
		- 'value', array('replacement')
		- 'value', array('replacement-if-true', 'replacement-if-false')
		- 'value', array('replacement-if-true', 'replacement-if-false', 'replacement-if-null')
	*/
	public static function trans($value, $replacement = '-') {
		if (is_array($replacement)) {
			if (count($replacement) > 2) {
				if ($value === null)
					return $replacement[2];
				elseif ($value)
					return $replacement[0];
				else
					return $replacement[1];
			}
			elseif (count($replacement) > 1)
				return $value?$replacement[0]:$replacement[1];
			else
				return call_user_func(__METHOD__, $value, $replacement[0]);
		}
		else
			return $value?$value:$replacement;
	}

	public static function passwordCrypt($str, $key=null) {
		return sha1($str.$key);
	}
	// Escape MySQL special caracters
	public static function mysqlEscape($str) { // Mimics mysql_real_escape_string, but without an active connection
		if(is_array($str))
			return array_map(__METHOD__, $str);

		if (!empty($str) && is_string($str))
			return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $str);

		return $str;
	}

	public static function hoursValueToStr($value) {
		if (!$value)
			return null;
		$hrs = floor($value);
		$mins = ($value - $hrs) * 60;
		$str = '';
		if ($hrs) {
			$str .= $hrs.'h';
			if ($hrs && $mins)
				$str .= $mins;
		}
		elseif ($mins)
			$str .= $mins.'mins';
		return $str;
	}
	function rudr_instagram_api_curl_connect( $api_url ){
		$connection_c = curl_init(); // initializing
		curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
		curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
		curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
		$json_return = curl_exec( $connection_c ); // connect and get json data
		curl_close( $connection_c ); // close connection
		return json_decode( $json_return ); // decode and return
	}
	public static function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
                              $quality            = 100,
                              $grayscale          = false
  		 ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    # Making the image grayscale, if needed
    if ($grayscale) {
      imagefilter($image, IMG_FILTER_GRAYSCALE);
    }    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
    return true;
  }

}
