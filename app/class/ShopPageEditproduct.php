<?php

class ShopPageEditproduct{
    
    public function __construct(){

        if(!UserAdmin::getInstance()->isLoggedIn()){
            Redirect::to(404);
        }

        $product = new ShopProduct(Module::getData(1));
        if(!$product->exists()) {
            Notify::set("danget", "WTF");
            Redirect::to(Link::to("shop", "dashboard"));
        }

        $theme = new ThemeShop();

        $theme->setTitle("Account");

        /*
        $theme->initJs('
        $(document).ready(function(){
        });
        ');		
        
        */
        $products = new ShopProduct;

        $image = new ShopProductImage;
        $image->row = $product->data();

        $content = '
		<div class="section">
			<div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <form action="'. Link::to('shop', 'adminaction') .'" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <img src="'. $image->getPath() .'" alt="" class="img-responsive">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                    '. ShopCategory::instance("all")->optionSelect($product->data()->category_id) .'
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" placeholder="Product name" value="'. _e($product->data()->title) .'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Description</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="description" class="form-control" placeholder="Description" rows="4"> '. _e($product->data()->description) .'</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="price_ins" class="form-control" placeholder="Price" maxlenght="10" value="'. _e($product->data()->price_ins) .'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Discount</label>
                                <div class="col-sm-9">
                                    <input type="text" name="discount" class="form-control" placeholder="Discount in %" maxlenght="2" value="'. _e($product->data()->discount) .'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Stars</label>
                                <div class="col-sm-9">
                                    <input type="text" name="stars" class="form-control" placeholder="Stars" maxlenght="1" value="'. _e($product->data()->stars) .'">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="file" name="img_file" class="form-control">
                            </div>
                            <input type="hidden" name="action" value="edit-product">
                            <input type="hidden" name="product_id" value="'. $product->data()->id .'">
                            <input type="hidden" name="token" value="'. Token::get() .'">
                            <button type="submit" class="btn btn-success">Ubdate</button>
                        </form>
                    </div>
                </div>
			</div>
        </div>
                ';

        $theme->render($content);
    }
}