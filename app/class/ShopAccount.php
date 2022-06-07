<?php

class ShopAccount{
    
    public function __construct(){


        switch(URL::getData(2)) {
            case 'logout':
                UserAdmin::getInstance()->logout();
                Redirect::to(Link::to("shop"));
            break;
        }

        if(Input::exists()){
            if(UserAdmin::getInstance()->login(Input::get('pwd'))){
                Notify::set("success", "Si nalogovaný.");
            }
            else{
                Notify::set("danger", "nem si nalogovaný.");
            }
            Redirect::to(Link::to("shop", "account"));
        }


        $theme = new ThemeShop();

        $theme->setTitle("Account");

        /*
        $theme->initJs('
        $(document).ready(function(){
        });
        ');		
        
        */

        $content = '

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <div class="col-md-6">
					    <form action="'. Link::to("shop", "account") .'" method="post">
                            <div class="form-group">
                                <label for="name">Heslo</label>
                                <input type="password" name="pwd" class="form-control" id="name" placeholder="Heslo" maxlenght="20">
                            </div>
                            <button type="submit" class="btn btn-success">Nalogovať</button> 
                        </form>
                    </div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
                ';

        $theme->render($content);
    }
}