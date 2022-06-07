<?php

class Log {

public static function save($page){
    if(!Config::exists("log/type")) {
        return;
    }
    switch(Config::get("log/type")) {
        case 'db':
            DB::getInstance()->insert("log", [
                "ip" => $_SERVER['REMOTE_ADDR'],
                "browser" => $_SERVER['HTTP_USER_AGENT'],
                "timestamp" => time(),
                "page" => $page,
            ]);
            break;

        case 'file':
            $path = Config::get("log/path");
            if(empty($path)) {
                return;
            }
            $data = [
                date("d.m.Y H:i:s"),
                $_SERVER['REMOTE_ADDR'],
                $page,
                $_SERVER['HTTP_USER_AGENT'],
            ];
            $data = implode("\t", $data) . PHP_EOL;
            file_put_contents(__PROJECTPATH__ . "/" . $path, $data, FILE_APPEND);
            break;
    }

}