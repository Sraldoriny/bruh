<?php

class Game {

    public $victory = false;

    public function __construct() {
        if(empty($this->getRandNum())) {
            $this->genRandNum();
        }
        if(Input::exists()){
            if(!is_numeric(Input::get('num'))){
                Notify::set('danger', $this->cheat_num(Input::get('num')));
                return;
            }
            $this->notifyCompare(Input::get('num'));
            return;
        }
        else {
            $this->init();
        }
    }

    public function init(){
        $this->genRandNum();
        $this->resetCounter();
    }

    public function notifyCompare($num) {

        $this->addCounter();
        if($num > $this->getRandNum()){
            Notify::set("danger","Myslel som si menšie číslo ako: " . $num);          
        }

        if($num < $this->getRandNum()){
            Notify::set("success", "Myslel som si <b>väčšie</b> číslo ako: " . $num);
        }
                
        if($num == $this->getRandNum()){
            Notify::set("info", "Uhádol si na " . $this->getCounter() .". pokus. Je to číslo ". $num);
            $this->victory = true;
            $this->init();
        }
        //var_dump($this->getCounter());
        //var_dump($this->getRandNum());
        
    }
    public function cheat_num($num) {
        if ($num === "bruh") {
            $this->victory = true;
            return "🥚" . $this->getRandNum() . "🥚";
        }
        else {
            return "si uplne vyparkovaný?!";
        }
    }

    public function getRandNum(){
        return $_SESSION['rand_num'];
    }

    public function genRandNum(){
        $_SESSION['rand_num'] = rand(1,100);
    }

    public function resetCounter() {
        $_SESSION['counter']=0;
    }

    public function addCounter(){
        $_SESSION['counter']++;
    }

    public function getCounter(){
        return $_SESSION['counter'];
    }

    public function htmlForm() {
        $html = '
        Myslel som si čislo od 1 do 100 Hádaj
        <br>
        ' . Notify::get() . '
        <br>
        <form action="'. Link::to("who", "game") .'" method="post">
            <input type="text" name="num" maxlength="4" required="required" autofocus>
            <button type="submit">Odoslať</button>
        </form>
        ';
        return $html;
    }
    
    public function html() {
        return Notify::get() . $this->htmlForm();
    }
    
}