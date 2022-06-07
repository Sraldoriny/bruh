<?php

class WhoIndex{
    
    public function __construct(){
        
        $theme = new ThemeWho();

        $theme->setTitle("Domov");

        /*
        $theme->initJs('
        $(document).ready(function(){
        });
        ');		
        
        */

        $content = '
        
        <div class="articles">
            
            <div class="box clearfix">
                <img src="'.$theme->getAssets().'/images/100x100/a.jpg">
                <h2><a href="#">StAr TrEk</a></h2>
                <p>
                    Emu hnedý (Dromaius novaehollandiae) je najväčší autochtónny vták Austrálie. Má chumáčovité, voľne 	                    splývajúce sivohnedé perie, mohutné nohy a krátke krídla.
                </p>
            </div>
            
        <div class="box clearfix">
            <img src="'.$theme->getAssets().'/images/100x100/a.jpg">
            <h2><a href="#">StAr TrEk</a></h2>
            <p>
                Emu hnedý (Dromaius novaehollandiae) je najväčší autochtónny vták Austrálie. Má chumáčovité, voľne 	                    splývajúce sivohnedé perie, mohutné nohy a krátke krídla.
            </p>
        </div>
        
        <div class="box clearfix">
            <img src="'.$theme->getAssets().'/images/100x100/a.jpg">
            <h2><a href="#">StAr TrEk</a></h2>
            <p>
                Emu hnedý (Dromaius novaehollandiae) je najväčší autochtónny vták Austrálie. Má chumáčovité, voľne 	                    splývajúce sivohnedé perie, mohutné nohy a krátke krídla.
            </p>
            </div>
        
        <div class="box clearfix">
            <img src="'.$theme->getAssets().'/images/100x100/a.jpg">
            <h2><a href="#">StAr TrEk</a></h2>
            <p>
                Emu hnedý (Dromaius novaehollandiae) je najväčší autochtónny vták Austrálie. Má chumáčovité, voľne 	                    splývajúce sivohnedé perie, mohutné nohy a krátke krídla.
            </p>
         </div>
        
        </div>
            <div class="rightbox">    
        </div>
                ';

        $theme->render($content);
    }
}