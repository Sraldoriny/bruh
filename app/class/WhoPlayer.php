<?php

class WhoPlayer{
    
    public function __construct(){
        $player = new Player;

        $theme = new ThemeWho();

        $theme->setTitle("Players");

        $content = '
        <div class="articles">
            ' . Notify::get() . '
            <h2>Players</h2>
            '. $player->render() .'
        </div> 
        <div class="rightbox">
        </div>
            ';

        $theme->render($content);
    }
}