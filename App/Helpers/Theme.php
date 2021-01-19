<?php

class Theme{
    public static function template_path($name){
        return App::Setting('site_url') . 'Content/Themes/' . App::Setting('site_theme') . '/' . $name;
    }
}