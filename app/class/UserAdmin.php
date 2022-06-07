<?php

class UserAdmin {

	private static $_instance = null;
	private
		$pwd_hash = '6ecf63d678e1b3a0d04eff9be0453b13843eb4cf',
		$pwd_salt = '';

	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function login($pwd) {
		if($this->pwdHash($pwd) === $this->pwd_hash){
			$_SESSION['admin'] = true;
			return true;
		}
		$_SESSION['admin'] = false;
		return false;
	}

	public function pwdHash($pwd){
        return sha1($pwd . $this->pwd_salt);
	}
	
    public function isLoggedIn(){
        if($_SESSION['admin'] === true){
            return true; 
        }
        return false;
	}
	public function logout(){
		$_SESSION['admin'] = false;
	}
	public function topMenu() {
		if($this->isLoggedIn()) {
			return '<li><a href="'. Link::to("shop", "account", "logout") .'"><i class="fa fa-bug" aria-hidden="true"></i>!(nalogovať)</a></li>
					<li><a href="'. Link::to("shop", "dashboard") .'"><i class="fa fa-bug" aria-hidden="true"></i>Dežobord</a></li>';
		}
	}
	
}