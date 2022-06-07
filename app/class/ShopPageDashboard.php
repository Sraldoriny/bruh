<?php

class ShopPageDashboard{
    
    public function __construct(){

        if(!UserAdmin::getInstance()->isLoggedIn()){
            Redirect::to(404);
        }

        $theme = new ThemeShop();

        $theme->setTitle("Dasdboard");
        $theme->addPlugin("redirect");

        $theme->initJs('
        $(document).ready(function(){
            $(".btn-remove").on("click", null, function(e){
                e.preventDefault();
                var link = "'. Link::to("shop", "adminaction") . '";
                var product_id = $(this).data("product");
                var action = "remove-product";
                $.redirect(
                    link,
                    {
                        action: action,
                        product_id: product_id,
                        token: "'. Token::get() .'"
                    }
                );
            });
        });
        ');

        $products = new ShopProduct;

        $content = '
		<div class="section">
			<div class="container">
				<div class="row">
                    <div class="col-md-6">
                        <a href="'. Link::to("shop", "addproduct") .'" class="btn btn-primary">Add product</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        '. $products->table() .'
                    </div>
                </div>
			</div>
        </div>
                ';

        $theme->render($content);
    }
}