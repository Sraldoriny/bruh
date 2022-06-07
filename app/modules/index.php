<?php

class Module_index extends Module { 

	public function start() {

		$theme = new Theme();

		$theme->setTitle("My first page");

		/*
		$theme->initJs('
$(document).ready(function(){
});
		');		
	
		*/

		$content = '
	<div class="jumbotron">
		<h1>Hello World!</h1>
		<p class="lead">This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll, this navbar remains in its original position and moves with the rest of the page.</p>
		<a class="btn btn-lg btn-primary" href="#" role="button">My first button</a>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<h2>Module: '. _e($this->getModuleName()) .'</h2>
			<p>Hard by a great forest dwelt a poor wood-cutter with his wife and his two children. The boy was called Hansel and the girl Gretel. He had little to bite and to break, and once, when great dearth fell on the land, he could no longer procure even daily bread.</p>
			<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
		</div>
		<div class="col-sm-6">
			<h2>Amazing story</h2>
			<p> Now when he thought over this by night in his bed, and tossed about in his anxiety. He groaned and said to his wife, "What is to become of us? How are we to feed our poor children, when we no longer have anything even for ourselves?"</p>
			<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
		</div>
		<div class="col-sm-6">
			<h2>Everybody talk</h2>
			<p>"I\'ll tell you what, husband," answered the woman, "early tomorrow morning we will take the children out into the forest to where it is the thickest. There we will light a fire for them, and give each of them one more piece of bread, and then we will go to our work and leave them alone. They will not find the way home again, and we shall be rid of them." </p>
			<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
		</div>
	</div>
		';

		$theme->render($content);

	}

}

