<?php

require __DIR__ . '/App/config.php';

$route  = explode('?', $_SERVER['REQUEST_URI']);
$route  = array_values(array_filter(explode('/', $route[0])));
if(SUBFOLDER_NAME != '/'){
    array_shift($route);
}

if(!App::Route(0)){
    $route[0] = 'index';
}

if(!file_exists(App::Controller(App::Route(0)))){
    $route[0] = '404';
}

require App::Controller(App::Route(0));