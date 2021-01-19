<?php

class Form{
    public static function Security($name){
        if(isset($_POST[$name])){
            if(is_array($_POST[$name])){
                return array_map(function($item){
                    return htmlspecialchars(trim($_POST[$name]));
                }, $_POST[$name]);
            }
            return htmlspecialchars(trim($_POST[$name]));
        }        
    }
}