<?php

class WhoGallery{
    
    public function __construct(){
        
        $Gallery = new Gallery;

        if(!empty($_FILES)) {
            if(UserAdmin::getInstance()->isLoggedIn()) {
                $Gallery->Upload();
            }
        }

        if(Input::issetGet("remove")) {
            if(UserAdmin::getInstance()->isLoggedIn()){
                $filename = urldecode(Input::get("remove"));
                $Gallery->removeImage($filename);
            }
        }

        $content = '
        <div class="articles">
            <h2>Galéria</h2>
            '. Notify::get() .'
            '. $Gallery->htmlUploadForm() .'
            '. $Gallery->htmlAll() .'
        </div>';
        $theme = new ThemeWho();
        $theme->setTitle("Galéria");
        $theme->initJs('
        $(document).ready(function(){
            $(".venobox").venobox();
        });
        ');		

        $theme->render($content);
    }
}