<?php

class Module_who extends Module { 
	
	private

		$pages = [
			'index',
			'gallery',
			'contact',
			'admin',
			'game',
			'cauculator',
			'snake',
			'pacman',
			'player'
		];

	public function start() {
		$module = Module::getData(0);
		if(empty($module)){
			$module = 'index';
		}
		/*if(!in_array($module,$this->pages) || Module::getData(1)){
			Redirect::to(404);
		}*/
		$o = 'Who'.ucfirst($module);
		new $o();
		

	}

}

