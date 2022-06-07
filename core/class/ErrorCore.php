<?php

/**
 * ERRORCORE
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

class ErrorCore {

	private static $template = 
	'<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Error</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400&subset=latin-ext" rel="stylesheet" type="text/css">
	<style>
	body {
		font-family: \'Open Sans\', Arial, sans-serif;
		font-size: 1em;
		padding: .8em;
	}
	.error {
		background-color: #F52626;
		color: #FFF;
		margin-top: 1em;
		padding: .8em;
		border-left: solid 5px #CCC;
	}
	</style>
</head>
<body>
	<div class="error">
		<strong>Error:</strong> %s
	</div>
</body>
</html>
';


	private static $_data;

	public static function render($string) {
		printf(self::$template, $string);
		exit;
	}

}