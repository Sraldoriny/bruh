<?php

class ShopProduct extends DBTableController{

    protected
        $_table = 'product';
    
    public function load($type, array $values = null) {
        switch($type) {
            case 'all':
                $table2 = ShopCategory::getInstance()->getFullTableName();
                $this->loadData([
                    'query' => "SELECT t1.*, t2.title as category_title FROM __table__ t1
                    LEFT JOIN $table2 t2 ON t2.id = t1.category_id
                    ORDER BY t2.title ASC, t1.title ASC;"
                ]);
                break;
                
                case 'new-products':
                    $table2 = ShopCategory::getInstance()->getFullTableName();
                    $this->loadData([
                        'query' => "SELECT t1.*, t2.title as category_title FROM __table__ t1
                        LEFT JOIN $table2 t2 ON t2.id = t1.category_id
                        ORDER BY t1.id DESC LIMIT 7;"
                    ]);
                    break;
                    case 'category':
                        $this->loadData([
                            'query' => "SELECT * FROM __table__ WHERE category_id = ?",
                            'values' => $values,
                        ]);
                        break;
        }
    }

    public function table() {
        $html = '';
        $this->load("all");
        foreach($this->data() as $row) {
            $html.= '
                    <tr>
                        <td>'. _e($row->title) .'</td>
                        <td>'. _e($row->category_title) .'</td>
                        <td>'. _e($row->price) .'</td>
                        <td>
                            <a href="'. Link::to("shop", "editproduct", $row->id) .'" class="text-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="text-danger btn-remove" data-product="'. $row->id .'"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>';
        }
        return '
        <table class="table table-bordered table-hover">
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            '. $html .'
        </table>
        ';
    }
    public function newProducts() {
        $this->load("new-products");
        $html = '';
        foreach ($this->data() as $row) {
            $html .= $this->htmlOne($row);
        }
        return $html;
    }
    public function htmlOne($row){
        $image = new ShopProductImage;
        $image->row = $row;


        $link = Link::to("shop", "product", $row->id);



        return '
            <div class="product">
                <div class="product-img">
                    <a href="'. $link .'"><img src="'. $image->getPath() .'" alt="" width="260px"></a>
                    <div class="product-label">
                        '. $this->makeDiscount($row->discount) .'
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category">'. _e($row->category_title) .'</p>
                    <h3 class="product-name"><a href="'. $link .'">'. _e($row->title) .'</a></h3>
                    <h4 class="product-price">'. $this->makePrice($row->price, $row->price_ins, $row->discount) .'</h4>
                    <div class="product-rating">
                        '. $this->makeStars($row->stars) .'
                    </div>
                    <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                </div>
            </div>
        ';
    }

    public function makeStars($num) {
        $html = '';
        for($i = 1; $i <= 5; $i++) 
        {
            if ($i <= $num) {
                $html .= '<i class="fa fa-star"></i> ';
            }
            else {
                $html .= '<i class="fa fa-star-o"></i> ';
            }
        }
        return $html;
    }
    public function makeDiscount($discount) {
        if ($discount) {
            return '<span class="sale">'. $discount .'%</span>';
        }
    }
    public function makePrice($price, $price_ins, $discount) {
        $html = _e($price) .' € ';
        if($discount) {
            $html .= '<del class="product-old-price">'. _e($price_ins) .'€</del>';
        }
        return $html;
    }
}