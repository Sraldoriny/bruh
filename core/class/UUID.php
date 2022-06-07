<?php

/**
 * UUID
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.12
 */

class UUID {

	public static function guid($namespace = '') {    
	    static $guid = '';
	    $uid = uniqid("", true);
	    $data = $namespace;
	    $data .= $_SERVER['REQUEST_TIME'];
	    $data .= $_SERVER['HTTP_USER_AGENT'];
	    $data .= $_SERVER['LOCAL_ADDR'];
	    $data .= $_SERVER['LOCAL_PORT'];
	    $data .= $_SERVER['REMOTE_ADDR'];
	    $data .= $_SERVER['REMOTE_PORT'];
	    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
	    $guid = '' .  
	            substr($hash,  0,  8) .
	            '-' .
	            substr($hash,  8,  4) .
	            '-' .
	            substr($hash, 12,  4) .
	            '-' .
	            substr($hash, 16,  4) .
	            '-' .
	            substr($hash, 20, 12) .
	            '';
	    return $guid;
	}

}
