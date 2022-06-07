<?php

class ShopCategory extends DBTableController {

    protected
        $_table = 'category';
    
    public function load($type, $value = null) {
        switch($type) {
            case 'all':
                $this->loadData([
                    'query' => "SELECT * FROM __table__ ORDER BY id ASC;"
                ]);
            break;
        
        }
    }


    public function headerMenu() {
        $html = '';
        $this->load("all");
        foreach($this->data() as $row) {
            $html.= '<li><a href="'. Link::to("shop", "category", $row->id) .'">'. _e($row->title) .'</a></li>';
        }
        return $html;
    }
    public function optionSelect($id = 0) {
        foreach($this->data() as $row){
            $s = '';
            if ($row->id == $id) {
                $s = 'selected';
            }
            $html.= '<option value="'. _e($row->id) .'" '. $s .'>'. _e($row->title) .'</option>';
        }
        return $html;
    }
}