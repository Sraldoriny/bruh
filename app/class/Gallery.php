<?php

class Gallery{

	public 
		$images = [],
		$path = '/gallery';

	public function __construct(){
		$this->load();
	}

	public function load(){
		$files = scandir(__PROJECTPATH__ . $this->path);
		foreach($files as $file){
			if($file == "." || $file == ".."){
				continue;
			}
			$file_path = __PROJECTPATH__ . $this->path .'/'. $file;
			$img_size = getImageSize($file_path);
			if($img_size === false)
				continue;
			$file_size = filesize($file_path);
			$this->images[] = [
				'filename'  => $file,
				'path'      => $file_path,
				'size'      => $file_size,
				'width'     => $img_size[0],
				'heigth'	=> $img_size[1],
			];
		}
	}

	public function htmlImage($image){
		$link = $this->path . '/'. $image['filename'];
		return '
                    <div class="picture">
                    '. $this->htmlRemove($image['filename']) .'
						<a href= "'. $link .'" class="venobox" data-gall="myGallery"><img src="'. $link .'"></a>
						'.$this->htmlImageSize($image).'
					</div>
		';
	
	}

	public function htmlImageSize ($image){

			return '
				<div>
					'. $image['width'] . ' x ' . $image['heigth'] .'
					<br>
					'. myFilesize($image['size'], 1) .'
				</div>';
	}

	public function htmlAll(){
		$html = '';
		foreach($this->images as $image){
			$html .= $this->htmlImage($image);
		}
		return '
			<div class="gallery clearfix">
				'.$html.'
			 </div>';
	}

	public function htmlUploadForm(){
		if(!UserAdmin::getInstance()->isLoggedIn())
			return '';
		return '
			<form action="'. Link::to("who", "gallery") .'" method="post" enctype="multipart/form-data">
				<input type="file" name="img_file">
				<button type="submit">Upload</button>
			</form>';
    }

    public function htmlRemove($filename){
		if(!UserAdmin::getInstance()->isLoggedIn())
			return;
            return '<a href="'. Link::to("who", "gallery", ["remove" => rawurlencode($filename) ]) .'" class="remove">X</a>';
    }

    public function removeImage($filename){
		if(!checkFilename($filename)){
			Notify::set("danger", "Neklam ma.");
			Redirect::to(Link::to("who", "gallery"));
		}
		$r = unlink(__PROJECTPATH__ . $this->path . "/" . $filename);
		if($r){
			Notify::set("success", "Obrázok bol odstranený.");
		}
		else{
			Notify::set("danger", "Obrázok nebol odstranený.");
		}
		Redirect::to(Link::to("who", "gallery"));
    }
    
    public function Upload() {

        $Upload = new Upload("img_file");
        $Upload->allowedImageOnly();
		if($Upload->check()) {
            $path = __PROJECTPATH__ . $this->path . "/" . $Upload->getFullName();
            $Upload->upload($path);
            Notify::set("success", "Obrázok bol uložený.");
        }		
        else{
            Notify::set("danger", Lang::getError($Upload->error()));
        }
        Redirect::to(Link::to("who", "gallery"));
        return;
	}
}