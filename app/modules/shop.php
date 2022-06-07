<?php

class Module_shop extends Module { 
	
	private

		$pages = [
			'index',
			'product',
			'category',
			'account',
			'dashboard',
			'addproduct',
			'adminaction',
			'editproduct',
		];

	public function start() {
		$module = Module::getData(0);
		if(empty($module)){
			$module = 'index';
		}
		/*if(!in_array($module,$this->pages) || Module::getData(1)){
			Redirect::to(404);
		}*/
		$o = 'ShopPage'.ucfirst($module);
		new $o();
		

	}

}
