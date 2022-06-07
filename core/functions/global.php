<?php
	/* version 1.05 */

	function e($string) {
		// $string = stripslashes($string);
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}

	function _e($string) {
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
	
	function checkSimpleStr($string){
		return (bool)preg_match('/^[a-zA-Z0-9-]+$/', $string);
	}
	
	/* v1.0 */
	function simpleStr($string){
		setlocale(LC_CTYPE, 'sk_SK.utf-8');
		$string = str_replace('-', ' ', $string);
		$string = preg_replace('/ +/', ' ', $string);
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
		$string = preg_replace('/[^A-Za-z0-9 -]/', '', $string);
		$string = trim($string);
		$string = str_replace(' ', '-', $string);
		$string = strtolower($string);
		return $string;
	}
	
	function simpleFilename($string){
		setlocale(LC_CTYPE, 'sk_SK.utf-8');
		$string = str_replace('_', ' ', $string);
		$string = preg_replace('/ +/', ' ', $string);
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
		$string = preg_replace('/[^A-Za-z0-9 _.]/', '', $string);
		$string = trim($string);
		$string = str_replace(' ', '_', $string);
		return $string;
	}

	/* v1.1 */
	function sanitize($rule_values, $string) {
		$state = explode("|", $rule_values);
		foreach($state as $sanitize_rule) {
			if(strpos($sanitize_rule, "-") !== false) {
				list($sanitize_rule, $value1, $value2) = explode("-", $sanitize_rule);
			}
			switch($sanitize_rule) {
				case 'trim':
					$string = trim($string);
				break; 
				case 'tab':
					$string = str_replace("\t", "", $string);
				break; 
				case 'tabSpace':
					$string = str_replace("\t", " ", $string);
				break; 
				case 'lf':
					$string = str_replace("\r", "", $string);
					$string = str_replace("\n", "", $string);
				break; 
				case 'tag':
					$string = strip_tags($string);
				break;
				case 'script':
					$string = preg_replace('/<script(.*)<\/script(.*)>/iu', '', $string);
				break;
				case 'slash':
					$string = stripslashes($string);
				break;
				case 'max':
					$string = mb_substr($string, 0, $value1);
				break;				
				case 'int':
					$string = (int) $string;
				break;		
			}
		}
		return $string;
	}

	function isValidEmail($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}	

	function isDigit($digit) {
		if(is_int($digit)) {
			return true;
		} elseif(is_string($digit)) {
			return ctype_digit($digit);
		} else {
			return false;
		}
	}

	function random_str($length = 4) {
		$s = base64_encode(random_bytes($length));
		if(strpos($s, "/") !== false) {
			$s = str_replace("/", chr(mt_rand(ord("A"), ord("Z"))), $s);
		}
		if(strpos($s, "+") !== false) {
			$s = str_replace("+", chr(mt_rand(ord("A"), ord("Z"))), $s);
		}
		return substr($s, 0, $length);
	}

if( !function_exists('random_bytes') ) {
	function random_bytes($length) {
		return openssl_random_pseudo_bytes($length);
	}
}

	function rand_str($length, $type = null)	{
		switch($type) {
			case 'alpha':
				$chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
			break;
			default:
				$chars = '0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
			break;
		}
		$string = '';
		$count_chars = strlen($chars);
		for($i = 0; $i < $length; $i++)
		{
			$string .= $chars[mt_rand(0, $count_chars-1)];
		}
		return($string);
	}

	function myCheckDate($date)	{
		$date = str_replace(" ", "", $date);
		if (!preg_match('/^(\d+)\.(\d+)\.(\d+)$/', $date, $match))
			return false;
		if (!checkdate((int) $match[2], (int) $match[1], (int) $match[3]))
			return false;
		return true;
	}

	function myDate($timestamp = null, $type = ''){
		if(!isset($timestamp)) {
			$timestamp = time();
		}
		if($timestamp == 0) {
			return '';
		}
		switch($type) {
			case 'short':
				return date('d.m.Y', $timestamp);
				break;
			case 'sec_less':
				return date('d.m.Y H:i', $timestamp);
				break;
		}
		return date('d.m.Y H:i:s', $timestamp);
	}	

	function myDateTime($datetime, $type = ''){
		$t = new DateTime($datetime);
		$timestamp = $t->getTimestamp();
		if($timestamp == 0)
			return '';
		switch($type) {
			case 'date':
				return date('d.m.Y', $timestamp);
			break;
			case 'time':
				return date('H:i', $timestamp);
			break;

		}
		return date('d.m.Y H:i:s', $timestamp);
	}	

	function myDateFromDB ($date) {
		if($date == "0000-00-00") {
			return '';
		}
		$d = explode('-', $date);
		$d = array_reverse($d);
		return implode('.', $d);
	}
	
	function array2csv(array &$array, $separator = ';')
	{
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		foreach ($array as $row) {
			fputcsv($df, $row , $separator);
		}
		fclose($df);
		return ob_get_clean();
	}

	function myFilesize($size, $digits = 1) {
		$mb = 1048576;

		$kb = 1024;

		if($size > $mb) {
			$size = round($size / $mb, $digits);
			$var = "MB";
		}
		elseif($size > $kb) {
			$size = round($size / $kb, $digits);
			$var = "kB";
		}
		else {
			$var = "B";
		}
		$text = $size . " " . $var;
		return $text;
	}

	function checkFilename($filename) {
		if (preg_match('/[\\/:*?<>|]/', $filename)) {
			return false;
		}
		return true;
	}

if( !function_exists('hex2bin') ) {
	function hex2bin($hex_string) {
		return pack("H*" , $hex_string);
	}
}

	function intArray(array $array) {
		$data = array();
		foreach($array as $value) {
			$data[] = (int) $value;
		}
		return $data;
	}

if (!function_exists('mb_ucfirst')) {
	function mb_ucfirst($string) {
		$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
		return $string;
	}
}

function myDiscount($price, $discount) {
	return round($price * (100 - $discount) / 100 , 2);
}