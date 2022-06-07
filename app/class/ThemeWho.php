<?php

class ThemeWho extends ThemeAbstract {

	protected
		$_assets = '/theme/who',
		$_icon = 'fa-home',
		$_page_nav = 'Page';

	protected
		$plugins = array(
			"dummy" => array(
				"css" => array(
					"/plugins/dummy/dummy.css",
				),
				"js" => array(
					"/plugins/dummy/dummy.js",
				)
			),
		);

	public function pageTop(){
		$this->_html = 
'
<!doctype html>
<html>
<head>
<meta charset="utf-8">
'. $this->meta() .'
<title>' . _e($this->title()) . '</title>
<link rel="stylesheet" href="'. $this->getAssets() .'/plugins/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="'. $this->getAssets() .'/css/main.css" type="text/css">
<link rel="stylesheet" href="'. $this->getAssets() .'/js/venobox/venobox.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="/favicon.png">
' . $this->createStyles() .'
</head>
<body>
';

	}
	
	public function pageHeader() {
		$this->_html .= '
	<div class="wrapper">
		<header> 
		'. $this->htmlLogout() .'
		</header>
		<div class="menu clearfix">
			<ul>
				<li><a href="'.Link::to('who').'">Domov</a></li>
				<li><a href="'.Link::to('who', 'gallery').'">Galéria</a></li>
				<li><a href="'.Link::to('who', 'contact').'">kontakt</a></li>
				<li><a href="'.Link::to('who', 'game').'">hra</a></li>
				<li><a href="'.Link::to('who', 'snake').'">snake</a></li>
				<li><a href="'.Link::to('who', 'pacman').'">pacman</a></li>
				<li><a href="'.Link::to('who', 'player').'">player</a></li>
			</ul>
		</div>
';
	}
	

	public function pageContent($content){
		$this->_html .= '

		<div class="content clearfix">
		'.$content.'
		</div>
';
	}
	
	public function pageFooter(){
		$this->_html .= '
		</div>
		<footer>
			<div class="wrapper clearfix">
				<div class="box">
					<img src="'. $this->getAssets().'/images/100x100/a.jpg" width="100" height="100">
					<h3><a href="#">Star Trek</a></h3>
					<p>Povozit na Lama Tatranska?</p>
				</div>
				<div class="box">
					<img src="'. $this->getAssets().'/images/100x100/b.png" width="100" height="100">
					<h3><a href="#">Good Omens</a></h3>
					<p>Povozit na Lama Tatranska?</p>
				</div>
				<div class="box">
					<img src="'. $this->getAssets().'/images/100x100/c.jpg" width="100" height="100"> 
					<h3><a href="#">The Sarah Jane Advent...</a></h3>
						<p>Povozit na Lama tatranska?</p>
				</div>
			</div>
			<br>
			©Martin Šedivý tel. +420 969148869
		</footer>
';
	}
	
	public function pageBottom(){
		$this->_html .= '
<!-- Global scripts -->
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="' . $this->_assets . '/js/popper.min.js"></script>
<script src="' . $this->_assets . '/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="' . $this->_assets . '/js/venobox/venobox.min.js"></script>
<!-- /Global scripts -->
<!-- Page scripts -->
' . $this->createScripts() .'
<!-- /Page scripts -->
'. $this->createJsInit() . '
</body>
</html>
';
	}

	public function getPage($content) {
		// top + header
		$this->pageTop();
		$this->pageHeader();
		// section + sidebar + content
		// $this->addHtml('      <section>');
		// $this->addHtml('            <div class="mainwrapper">');
		$this->pageContent($content);
		// $this->addHtml('            </div>');            
		// $this->addHtml('      </section>');
		// footer + bottom
		$this->pageFooter();
		$this->pageBottom();

		return $this->_html;
	}

	public function version() {
		return Config::get("app/version", "1.0.1");
	}

	public function footerCopyright() {
		return Config::get("web/footer_copyright", '© '. date("Y") .' &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; Web app version: ' . $this->version());
	}
	public function htmlLogout(){
		if(UserAdmin::getInstance()->isLoggedIn()){
			return'
		Prihlásený: admin | <a href="'.Link::to('who','admin','logout').'">
			Odhlásiť sa</a>
		';
		}
		else{	
			return;	
		}
	}

}
