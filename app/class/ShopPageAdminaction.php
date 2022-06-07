<?php

class ShopPageAdminaction{
    
    public function __construct(){

        if(!UserAdmin::getInstance()->isLoggedIn()) {
            Redirect::to(404);
        }

        if(!Input::exists()) {
            Redirect::to(404);
        }

        if(!Token::check(Input::get("token"))) {
            Redirect::to(404);
        }

        switch(Input::get("action")) {
            case 'add-product':
                $product = new ShopProduct();
                $r = $product->insert([
                    "category_id" => (int) Input::get("category_id"),
                    "title" => sanitize("trim", Input::get("title")),
                    "description" => sanitize("trim", Input::get("description")),
                    "price_ins" => sanitize("trim", Input::get("price_ins")),
                    "price" => myDiscount( (float) Input::get("price_ins"), (int) Input::get("discount")),
                    "discount" => sanitize("trim", Input::get("discount")),
                    "stars" => sanitize("trim", Input::get("stars")),
                    "created" => time(),
                ]);
                
                if($r){
                    $last_id = $product->lastInsertedId();
                    $var = 'img_file';
                    if($_FILES[$var]['error'] === UPLOAD_ERR_OK) {
                        $product = new ShopProduct($last_id);
                        $image = new ShopProductImage;
                        $image->Product = $product;
                        try{
                        $image->upload($var);
                        }
                        catch (Exception $e) {
                            Notify::set('danger', $e->getMessage());
                        }
                    }
                    Notify::set("success", "Product has been successfully added.");
                }
                else {
                    Notify::set("danger", "Thomas had never seen such bulls**t before.");
                }
                Redirect::to(Link::to("shop", "dashboard"));
                
            break;

            case 'edit-product':
                $product = new ShopProduct(Input::get("product_id"));
                $r = $product->update([
                    "category_id" => (int) Input::get("category_id"),
                    "title" => sanitize("trim", Input::get("title")),
                    "description" => sanitize("trim", Input::get("description")),
                    "price_ins" => sanitize("trim", Input::get("price_ins")),
                    "price" => myDiscount( (float) Input::get("price_ins"), (int) Input::get("discount")),
                    "discount" => sanitize("trim", Input::get("discount")),
                    "stars" => sanitize("trim", Input::get("stars")),
                    "created" => time(),
                ]);
                if($r) {
                    Notify::set("success", "ubdate successfull");
                    $var = 'img_file';
                    if($_FILES[$var]['error'] === UPLOAD_ERR_OK) {
                        $product = new ShopProduct($last_id);
                        $image = new ShopProductImage;
                        $image->Product = $product;
                        try{
                            $image->upload($var);
                        }
                        catch (Exception $e) {
                            Notify::set('danger', $e->getMessage());
                        }
                    }
                }
                Redirect::to(Link::to("shop", "dashboard"));
            break;
            case 'remove-product':
                $product = new ShopProduct(Input::get("product_id"));
                if($product->exists()) {
                    $r = $product->delete();
                    if($r) {
                        Notify::set("success", "The product has been successfully removed.");
                    }
                    else {
                        Notify::set("danger", "THE PRODUCT CAN'T DIE OH NO");
                    }
                    $image = new ShopProductImage;
                    $image->Product = $product;
                    if($image->delete()) {
                        Notify::set("success", "The image has been successfully removed.");
                    }
                }
                Redirect::to(Link::to("shop", "dashboard"));
            break;
        }

    }
}