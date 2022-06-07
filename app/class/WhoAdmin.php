<?php

class WhoAdmin{
    
    public function __construct(){
        
        switch(URL::getData(2)) {
            case 'logout':
                UserAdmin::getInstance()->logout();
                Redirect::to(Link::to("who"));
            break;
        }

        if(Input::exists()){
            if(UserAdmin::getInstance()->login(Input::get('pwd'))){
                Notify::set("success", "Si nalogovaný.");
            }
            else{
                Notify::set("danger", "nem si nalogovaný.");
            }
            Redirect::to(Link::to("who", "admin"));
        }
    
        $theme = new ThemeWho();

        $theme->setTitle("Admin");

        $content = '
        <div class="articles">
            <h2>Prihlás sa</h2>
            ' . Notify::get() . '
            <form action="'. Link::to("who", "admin") .'" method="post">
                <div class="row">
                    <input type="password" name="pwd" placeholder="Heslo" class="text"  autofocus>
                        <button type="submit">Prihlásiť</button>
                </div>
            </form>
        </div> 
        <div class="rightbox">
        </div>
            ';

        $theme->render($content);
    }
}