<?php

class WhoContact{
    
    public function __construct(){
        $mojmajl = 'sedivymartin757@gmail.com';
        $predmet = 'z form';
        if(UserAdmin::getInstance()->isLoggedIn()){
            $admindata = '
        <div class="form-group">
            <label for="name">predmet</label>
            <input type="text" name="predmet" class="form-control" id="name" placeholder="Zadaj meno" maxlenght="50">
        </div>
            <div class="form-group">
            <label for="email">mojEmail adresa</label>
            <input type="email" name="mojemail" class="form-control" id="email" placeholder="Zadaj email" maxlenght="100">
        </div>
        ';      
        $mojmajl = Input::get('mojemail');
        $predmet = Input::get('predmet');
        }
        if(Input::exists()){
            if(!(Post::exists('lama1') && !Post::exists('lama2'))){
                Notify::set("danger","Si <b>BLBÝ</b> lebo si L.");
                Redirect::to(Link::to('who', 'contact'));
            }
            $name=sanitize('trim|lf|script|max-50',Input::get('name'));
            $msg=sanitize('trim|script|max-2500',Input::get('msg'));
            $email=Input::get('email');
            if(empty($name) || empty($msg) || !isValidEmail($email)){
                Notify::set("danger","Si <b>L</b>. Email je blbý alebo si nezaplnil nejaké políčko.");
                Redirect::to(Link::to("who", "contact"));
            }
            $mail= new PHPMailer;
            $mail->setFrom($email, $name);
            $mail->addAddress(''. $mojmajl .'');
            $mail->isHTML(true);
            $mail->Subject = $predmet;
            $mail->Body    = nl2br(htmlspecialchars($msg ,ENT_COMPAT));
            $mail->CharSet = 'utf-8';
            if($mail->send()) {
                Notify::set("info", "poslane");
            }
            else {
                Notify::set("danger", "nem poslane");
            }
            Redirect::to(Link::to("who", "contact"));
        }
        
        $theme = new ThemeWho();

        $theme->setTitle("Kontakt");

        /*
        $theme->initJs('
        $(document).ready(function(){
        });
        ');		
        
        */

        $content = '
        

            <div class="articles">
                '. Notify::get() .'
                <form action="'. Link::to("who", "contact") .'" method="post">
                    <div class="form-group">
                        <label for="name">Meno</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Zadaj meno" maxlenght="50">
                    </div>
                    '. $admindata .'
                    <div class="form-group">
                        <label for="email">Email adresa</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Zadaj email" maxlenght="100">
                        <small id="email" class="form-text text-muted">Zaspamujem ti email.</small>
                    </div>
                    <div class="form-group">
                        <label for="msg">Správa</label>
                        <textarea class="form-control" name="msg" id="msg" rows="3" placeholder="Zadaj správu" maxlenght="2500"></textarea>
                        <small id="msg" class="form-text text-muted">Prosím zadaj správu pre admina.</small>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1" name="lama1">
                        <label class="custom-control-label" for="check1">KILKAŤ</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2" name="lama2">
                        <label class="custom-control-label" for="check2">NEMKILKAŤ</label>
                    </div>
                    <button type="submit" class="btn btn-success">Poslať hackerom</button> 
                </form>
            </div>
            <div class="rightbox">
            </div>   
            
        ';

        $theme->render($content);
    }
}