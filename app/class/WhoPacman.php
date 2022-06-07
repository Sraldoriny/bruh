<?php

class WhoPacman{
    
    public function __construct(){
        
        $theme = new ThemeWho();

        $theme->setTitle("Packman");

        $content = '
            <div class="articles">
                <h2>Pacman</h2>
                <div class="clearfix">	
                    <canvas id="pmcanvas" width="448" height="496" class="pacman"></canvas>
                    <div id="point-counter" class="text"></div>
                    <div id="welcome" class="text" style="width: 448px; margin-left: 5px; text-align: justify;">
                    <p>Poď si zahrať Pacmana!</p>
                    <p>
                        <label>Napíš sem svoje meno a stlač Enter: </label>
                        <input type="text" id="namebox" name="Name" />
                    </p>
                    </div>

                    <div class="item">
                        <div id="result-view" class="hidden">
                            <span id="result-msg" class="largeText"></span>
                            <br />
                            <table id="score-table" class="text" style="border: solid 1px white; margin: 0 auto;"></table>
                            <br />
                            <div class="button">
                                <a href="#" onclick="pacman.engine.newGame(pacman.model.username); pacman.engine.hideResultView();">Hrať znova</a>
                            </div>
                        </div>
                    </div>
                    <script src="/theme/who/js/pacman.js"></script>
                </div>
            </div>
            <div class="rightbox">
            </div>
        ';

        $theme->render($content);
    }
}