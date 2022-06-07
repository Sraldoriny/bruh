<?php

/**
 * THEME
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.14
 */

abstract class ThemeAbstract {

	protected
		$_assets = '/theme/assets',
		$_html = '',
		$_meta = '',
		$_title,
		$_title_type,		
		$_css,
		$_js,
		$_jsInit,
		$_pageName;

	protected $plugins;

	public function __construct(){
	}
	
	abstract function pageTop();
	abstract function pageHeader(); 
	abstract function pageContent($content);
	abstract function pageFooter();
	abstract function pageBottom();

	public function getPage($content) {
		//header
		$this->pageTop();
		$this->pageHeader();
		
		// content
		$this->pageContent($content);
		
		// footer
		$this->pageFooter();
		$this->pageBottom();

		return $this->_html;
	}

	public function render($content) {
		echo $this->getPage($content);
		exit;
	}

	/* 
	 *  ----  CSS  -------------------
	 */
	public function addCss($url){
		if(is_array($this->_css)) {
			$this->_css = array_merge($this->_css, $url);
		}
		else {
			$this->_css = $url;
		}
	}
	
	protected function createStyles() {
		$input = $this->_css;
		if(!is_array($input)) {
			return $input;
		}
		$html_style_url = null;
		foreach($input as $url) {
				$html_style_url .= '<link rel="stylesheet" type="text/css" href="'. $this->_assets . trim($url) .'">'."\n";
		}
		return $html_style_url;
	}

	public function initJs($init){
		$this->_jsInit .= $init;
	}    


	
	/* 
	 *  ----  JavaScript  -------------------
	 */
	public function addJs($url){
		if(is_array($this->_js)) {
			$this->_js = array_merge($this->_js, $url);
		}
		else {
			$this->_js = $url;
		}
	}

	protected function createScripts(){
		$input = $this->_js;
		if(!is_array($input)){
			return $input;
		}
		$html_script_url = null;
		foreach($input as $url) {
				$html_script_url .= '<script type="text/javascript" src="'. $this->_assets . trim($url) .'"></script>'."\n";
		}
		return $html_script_url;
	}
	
	protected function createJsInit() {
		if(empty($this->_jsInit)) {
			return '';
		}
		return '
<script>
' . $this->_jsInit . '
</script>
';
	}

	/* 
	 *  ----  Plugins  -------------------
	 */

	public function addPlugin($name, $replace = null) {
		if(is_array($this->plugins[$name]["css"])) {
			$this->AddCss($this->plugins[$name]["css"]);
		}
		if(is_array($this->plugins[$name]["js"])) {
			if(is_array($replace)) {
				$this->replace($name, "js", $replace);
			}
			$this->AddJs($this->plugins[$name]["js"]);
		}
	}

	public function replace($name, $type, $replace) {
		$temp = array();
		foreach($this->plugins[$name][$type] as $key => $url) {
			foreach($replace as $r_name => $r_value) {
				$url = str_replace("{".$r_name."}", $r_value, $url);
			}
			$temp[] = $url;
		}
		$this->plugins[$name][$type] = $temp;
	}


	/* 
	 *  ----  Head  -------------------
	 */

	public function setTitle($title, $type = null){
		$this->_title = $title;	
		$this->_title_type = $type;	
	}

	public function title(){
		if($this->_title_type == "custom") {
			return $this->_title;	
		}
		else {
			return $this->_title . Config::get("web/title");
		}
	}

	public function addMeta($name, $content){
     // description, keywords, copyright, author, language
		$this->_meta .= PHP_EOL .'	<meta name="'. $name .'" content="' . escape($content) . '">';
	}

	public function meta() {
		return $this->_meta;
	}


	/* 
	 *  ----  Other  -------------------
	 */


	public function pageName($pageName) {
		$this->_pageName = $pageName;
	}

	public function addHtml($content){
		$this->_html .= $content;
	}

	public function getAssets() {
		return $this->_assets;
	}

}
