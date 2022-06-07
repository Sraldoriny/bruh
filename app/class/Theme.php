<?php

class Theme extends ThemeAbstract {

	protected
		$_assets = '/theme/assets',
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
'<!DOCTYPE html>
<html lang="'. Lang::getLang() .'">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="author" content="APPLICATION">
	<meta name="robots" content="noindex, nofollow">
'. $this->meta() .'
	<title>' . _e($this->title()) . '</title>
	<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/plugins/bootstrap/css/bootstrap.min.css">
' . $this->createStyles() .'
	<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/css/main.css">
</head>
<body>
';

	}
	
	public function pageHeader() {
		$this->_html .= '
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
			<a class="navbar-brand" href="#">LOGO</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
				</ul>
				<form class="form-inline mt-2 mt-md-0">
					<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>	
	</header>
';
	}
	

	public function pageContent($content){
		$this->_html .= '

	<main role="main" class="container">
		<div class="row">
			<div class="col-sm-12">
				'. Notify::get("solid_left") .'
			</div>
		</div>
		'. $content .'
	</main>
';
	}
	
	public function pageFooter(){
		$this->_html .= '
	<footer class="container">
		<hr>
			'. $this->footerCopyright() .'
	</footer>
	<!-- /Footer -->
';
	}
	
	public function pageBottom(){
		$this->_html .= '
<!-- Global scripts -->
<script src="' . $this->_assets . '/js/jquery-3.3.1.slim.min.js"></script>
<script src="' . $this->_assets . '/js/popper.min.js"></script>
<script src="' . $this->_assets . '/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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

}
