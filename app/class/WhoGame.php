<?php

class WhoGame{
    
    public function __construct(){
        
        $Game = new Game;

        $theme = new ThemeWho();

        $theme->setTitle("Hra");
        /*$theme->addJs([
            '/js/confety.js'
        ]);
        $theme->initJs('
            var start ='. $Game->victory .';
            if (start) {
                startConfetti();
            }
        ');
        <script type="text/javascript" src="/theme/who/js/confety.js"></script>
            <script>
                var start ='. $Game->victory .';
                if (start) {
                    startConfetti();
                }
                </script>*/

        $content = '
            <div class="articles">
                <h2>Hra</h2>
                '.$Game->html().'
            </div>
            <div class="rightbox">   
            </div>
        ';

        $theme->render($content);
    }
}