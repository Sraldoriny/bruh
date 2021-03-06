<?php



class ThemeShop extends ThemeAbstract {

	protected
		$_assets = '/theme/electro',
		$_icon = 'fa-home',
		$_page_nav = 'Page';

	protected
		$plugins = array(
			"redirect" => array(
				"js" => array(
					"/js/jquery.redirect.js",
				)
			),
		);

	public function pageTop(){
		$this->_html = 
'<!DOCTYPE html>
<html lang="'. Lang::getLang() .'">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
'. $this->meta() .'
<title>' . _e($this->title()) . '</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/css/slick.css"/>
<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/css/slick-theme.css"/>
' . $this->createStyles() .'
<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/css/nouislider.min.css"/>
<link rel="stylesheet" href="' . $this->_assets . '/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="' . $this->_assets . '/css/style.css"/>


<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
';

	}
	
	public function pageHeader() {
		$this->_html .= '
        <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +420-69-66-66</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-sort" aria-hidden="true"></i> EMERALD</a></li>
                    <li><a href="'. Link::to("shop", "account") .'"><i class="fa fa-user-o"></i> My Account</a></li>
                    '. UserAdmin::getInstance()->topMenu() .'
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="/shop/" class="logo">
                                <img src="' . $this->_assets . '/img/output-onlinepngtools (1).png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                <select class="input-select">
                                    <option value="0">All Categories</option>
                                    <option value="1">Category 01</option>
                                    <option value="1">Category 02</option>
                                </select>
                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="' . $this->_assets . '/img/product01.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="' . $this->_assets . '/img/product02.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">3x</span>$80.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) selected</small>
                                        <h5>SUBTOTAL: $2940.00</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                   '. ShopCategory::getInstance()->headerMenu() .'
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
';
	}
	

	public function pageContent($content){
		$this->_html .= '
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
                <div class="row">
                '. Notify::get("solod_left") .'
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <!-- /SECTION -->
        
        '. $content .'
';
	}
	
	public function pageFooter(){
		$this->_html .= '
        <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                            '. ShopCategory::getInstance()->headerMenu() .'
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                    </div>
                </div>
                    <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
';
	}
	
	public function pageBottom(){
        $this->_html .= '
        
        <script src="' . $this->_assets . '/js/jquery.min.js"></script>
		<script src="' . $this->_assets . '/js/bootstrap.min.js"></script>
		<script src="' . $this->_assets . '/js/slick.min.js"></script>
		<script src="' . $this->_assets . '/js/nouislider.min.js"></script>
		<script src="' . $this->_assets . '/js/jquery.zoom.min.js"></script>
		<script src="' . $this->_assets . '/js/main.js"></script>



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
		return Config::get("web/footer_copyright", '?? '. date("Y") .' &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; Web app version: ' . $this->version());
	}

}