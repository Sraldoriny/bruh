<?php

class ShopProductImage {

    private
        $_path = '/img/p/';

    public
        $Product,
        $row;

    public function upload($var) {
        $upload = new Upload($var);
        $upload->allowedImageOnly();
        if(!$upload->check()){
            throw new Exception("A bug has been spotted.");
        }
        $ext = $upload->getExt();
        $code = rand_str(6);
        $filename = $this->Product->data()->id . "-" . $code . "." . $ext;

        $this->Product->update([
            "img_file" => $filename,
        ]);
        if($this->Product->data()->img_file) {
            $this->delete();
        }
        $upload->upload($this->getAbsolutePath($filename));
    }
    public function getAbsolutePath($filename) {
        return __PROJECTPATH__ . $this->_path . $filename;
    }

    public function getPath() {
        $filename = $this->row->img_file;
        if(empty($filename)) {
            return $this->_path . "noImg.png";
        }
        return $this->_path . $filename;
    }

    public function delete() {
        $filename = $this->Product->data()->img_file;
        if (empty($filename)) {
            return false;
        }
        $path = $this->getAbsolutePath($filename);
        if(@unlink($path)) {
            return true;
        }
        return false;
    }
}