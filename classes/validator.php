<?php

class Validator
{

		/**
		 * validator config
		 *
		 * @var array
		 */
		private $config;

		/**
		 * messages
		 *
		 * @var array
		 */

		private $messages = array(
			'required' => 'Ce champs est obligatoire.',
			'int' => 'Le champs %label% doit etre entier',
			'alpha' => 'Le champs %label% doit etre alphabetique',
			'alphanum' => 'Le champs %label% doit etre alphanumérique',
			'email' => 'Cet email n\'est pas valide',
			'tel' => 'numero de telephone invalid',
			'text' => 'Le champs %label% ne doit pas contenir des caractères specials',
			'date' => 'Le champs %label% n\'est pas une date valide',
		);

		/**
		 * messages
		 *
		 * @var array
		 */

		private $message = array();
		/**
		*
		* @param type description
		*/
		public function __construct($config){
				if($config && is_array($config)){
						$this->config = $config;
				} else {
					throw new \Exception("Error Processing validator, your config is uncorrect", 1);

				}
		}

		/**
		 * validate int
		 *
		 * @param string/int $item
 		 * @return return boolean
		 */
		public function int($item)
		{
			return is_integer($item);
			// return preg_match('/[\d]+/', $item);
		}

		/**
		* validate text
		*
		* @param string $item
		* @return return boolean
		*/
		public function text($item)
		{
				return preg_match('@^[\d\w%:&^$#!\?\s~\*\'"/.\(\)/,;\+\-\@]+$@i', $item);
		}

		/**
		* validate tel
		*
		* @param string $item
		* @return return boolean
		*/
		public function tel($item)
		{
				return preg_match('/^[\d\s\+]{6,15}$/i', $item);
		}

		/**
		* validate date
		*
		* @param string $item
		* @return return boolean
		*/
		public function date($date, $format = 'Y-m-d')
		{
			$d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
		}

		/**
		* validate alpha num
		*
		* @param string $item
		* @return return boolean
		*/
		public function aphanum($item)
		{
				return ctype_alnum($item);
		}

		/**
		* validate alpha
		*
		* @param string $item
		* @return return boolean
		*/
		public function alpha($item)
		{
				return ctype_alpha($item);
		}

		/**
		* validate alpha
		*
		* @param string $item
		* @return return boolean
		*/
		public function required($item)
		{
				return count($item) > 0;
		}

		/**
		* validate email
		*
		* @param string $item
		* @return return boolean
		*/
		public function email($item)
		{
				$pattern = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

				return preg_match($pattern, $item);
		}

		/**
		* run validator
		*
		* @param string $item
		* @return return sting
		*/
		public function getMessage($item = NULL)
		{
				if($item){
					 return isset($this->message[$item]) ? $this->message[$item]: 1;
				} else {
					return implode("<br><br>", $this->message);
				}
		}

		/**
		* run validator
		*
		* @param string $item
		* @return return boolean
		*/
		public function run()
		{
				$return = TRUE;
				foreach ($this->config as $field => $config){
					 $filters = explode('|',$config['filter']);
					 $label = $config['label'];
					 /* cleaners */
					 if(in_array('trim', $filters)){
						 $_POST[$field] = trim($_POST[$field]);
					 }

					 if(in_array('strip_tags', $filters)){
						 $_POST[$field] = strip_tags($_POST[$field]);
					 }
					 /* cleaners */

					 foreach ($filters as $key => $filter) {
					 			if(in_array($filter, array('trim', 'strip_tags'))){
									continue;
								}
								$valid = $this->{$filter}($_POST[$field]);
								if(!$valid){
									$this->message[$field]  = str_replace('%label%', $label, $this->messages[$filter]);
								}

								$return  = $return && $valid;
					 }
				}
				return $return;
		}
}