<?php

class ShopPageCategory{
    
    public function __construct(){

        $category_id = Module::getData(1);
        $category = new ShopCategory();
        if($category->exists()) {
            Redirect::to(Link::to("shop"));
        }

        $products = new ShopProduct();
        $products ->load("category", [Module::getData(1)]);
        
        $html = '';
        foreach ($products->data() as $row) {
            $html .= '<div class="col-md-4 col-xs-6">' . $products->htmlOne($row) . '</div>';
        }

        $theme = new ThemeShop();

        $theme->setTitle("Category: " . _e($category->data()->title));

        /*
        $theme->initJs('
        $(document).ready(function(){
        });
        ');		
        
        */

        $content = '

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Category '. _e($category->data()->title) .'</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
                        <!-- /store top filter -->
                        
                        <div class="row">
                            <div class="flex">
                                '. $html .'
                            </div>
                        </div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
                ';

        $theme->render($content);
    }
}