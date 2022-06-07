<?php

class ShopPageAddproduct{
    
    public function __construct(){

        if(!UserAdmin::getInstance()->isLoggedIn()){
            Redirect::to(404);
        }

        /*switch(URL::getData(2)) {
            case 'logout':
                UserAdmin::getInstance()->logout();
                Redirect::to(Link::to("shop"));
            break;
        }

        if(Input::exists()){
            if(UserAdmin::getInstance()->login(Input::get('pwd'))){
                Notify::set("success", "Si nalogovaný.");
            }
            else{
                Notify::set("danger", "nem si nalogovaný.");
            }
            Redirect::to(Link::to("shop", "account"));
        }*/


        $theme = new ThemeShop();

        $theme->setTitle("Account");

        /*
        $theme->initJs('
        $(document).ready(function(){
        });
        ');		
        
        */
        $products = new ShopProduct;

        $content = '
		<div class="section">
			<div class="container">
                <div class="row">
                    <div class="col-md-6">
                    <form action="'. Link::to('shop', 'adminaction') .'" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                '. ShopCategory::instance("all")->optionSelect() .'
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Product name" maxlenght="">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="description" class="form-control" placeholder="Description" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="price_ins" class="form-control" placeholder="Price" maxlenght="10">
                            </div>
                            <div class="form-group">
                                <input type="text" name="discount" class="form-control" placeholder="Discount in %" maxlenght="2">
                            </div>
                            <div class="form-group">
                                <input type="text" name="stars" class="form-control" placeholder="Stars" maxlenght="1">
                            </div>
                            <div class="form-group">
                                <input type="file" name="img_file" class="form-control">
                            </div>
                            <input type="hidden" name="action" value="add-product">
                            <input type="hidden" name="token" value="'. Token::get() .'">
                            <button type="submit" class="btn btn-success">Pridať</button>
                        </form>
                    </div>
                </div>
			</div>
        </div>
                ';

        $theme->render($content);
    }
}