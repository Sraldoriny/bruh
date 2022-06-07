<?php

class Player {

    public 
        $players;
    public function __construct(){
        $this->players = DB::getInstance()->query("SELECT * FROM players ORDER BY name ASC;")->all();
        if(UserAdmin::getInstance()->isLoggedIn()){
            if(Input::exists()) {
                $this->adminAppPlayer();
            }
            switch(Module::getData(1)){
                case 'delete':
                    $this->adminDelete();
                break;
            }
        }
    }
    public function adminDelete(){
        $validate = new Validate();
        $validate->check($_GET, [
            "id" => [
                "required" => true,
                "decimal" => true,
            ]
        ]);
        if($validate->errors()){
            Notify::set('danger', $validate->htmlErrors());
            Redirect::to(Link::to('who', 'player'));
        }
        $r = DB::getInstance()->delete("players", ["id", "=", Input::get("id")]);
        if($r){
            Notify::set("success", 'Hráč s id <b>'. _e(Input::get("id")) .'</b> bol opľutý.');
        }
        else{
            Notify::set('danger', 'Chyba opľutia hráča');
        }
        Redirect::to(Link::to('who','player'));
    }
    public function adminForm(){
        if(!UserAdmin::getInstance()->isLoggedIn()){
            return '';
        }
        return '
        <div class="row">
            <div class="col-md-6">
                <form action="'. Link::to('who', 'player') .'" method="post">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Meno" maxlenght="25">
                    </div>
                    <div class="form-group">
                        <input type="text" name="level" class="form-control" placeholder="Level" maxlenght="3">
                    </div>
                    <div class="form-group">
                        <input type="text" name="exp" class="form-control" placeholder="Exp" maxlenght="10">
                    </div>
                    <div class="form-group">
                        <input type="text" name="money" class="form-control" placeholder="Prachy" maxlenght="10">
                    </div>
                    <button type="submit" class="btn btn-success">Pridať hráča</button>
                </form>
            </div>
        </div>
    ';
    }

    public function adminAppPlayer() {
        $validate = new Validate();
        $validate->check($_POST, [
            "name" => [
                "required" => true,
                "max" => 25,
            ],
            "level" => [
                "required" => true,
                "max" => 3,
                "decimal" => true,
            ],
            "exp" => [
                "required" => true,
                "max" => 10,
                "decimal" => true,
            ],
            "money" => [
                "required" => true,
                "max" => 10,
                "decimal" => true,
            ],
        ]);
        if($validate->errors()){
            Notify::set('danger', $validate->htmlErrors());
            Redirect::to(Link::to('who', 'player'));
        }

        $r = DB::getInstance()->insert("players", [
            "name" => Input::get("name"),
            "id" => Input::get("id"),
            "level" => Input::get("level"),
            "exp" => Input::get("exp"),
            "money" => Input::get("money"),
        ]);

        if($r){
            Notify::set('success', 'Hráč s menom <b>'. _e(Input::get("name")) .'</b> bol pridaný do databázy.');
        }
        else{
            Notify::set('danger', 'Chyba zápisu do databázy.');
        }
        Redirect::to(Link::to('who','player'));
    }

    public function getRows(){
        $html = '';
        foreach($this->players as $row){
            $admin_id = '';
            $admin_action = '';
            if(UserAdmin::getInstance()->isLoggedIn()){
                $admin_action = '<td><a href="'. Link::to('who', 'player', 'delete', ['id' => $row->id]) .'"><b>SPIT</b></a></td>';
                $admin_id = '<td>'. _e($row->id) .'</td>';
            }
            $html .= '
                <tr>
                    <td class="left-align">'. _e($row->name) .'</td>
                    '. $admin_id .'
                    <td>'. _e($row->level) .'</td>
                    <td>'. _e($row->exp) .'</td>
                    <td>'. _e($row->money) .'</td>
                    '. $admin_action .'
                </tr>
            ';
        }
        return $html;
    }
    public function getTable(){
        $admin_id = '';
        $admin_action = '';
        if(UserAdmin::getInstance()->isLoggedIn()){
            $admin_id = '<th>Id</th>';
            $admin_action = '<th>Action</th>';
        }
        return'
            <table class="player">
                <tr>
                    <th>Name</th>
                    '. $admin_id .'
                    <th>Level</th>
                    <th>Exp</th>
                    <th>Money</th>
                    '. $admin_action .'
                    
                </tr>
                ' . $this->getRows() . '
            </table>';

    }
    public function render(){
        return $this->getTable() . $this->adminForm();
    }
}