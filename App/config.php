<?php

ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
error_reporting(-1);
setlocale(LC_TIME, "turkish");
setlocale(LC_ALL,'turkish');

define('ABSPATH', dirname(dirname(__DIR__)).'/');
define('SUBFOLDER_NAME', dirname($_SERVER['SCRIPT_NAME']));
define('PATH', realpath('.'));

session_start();
ob_start();
date_default_timezone_set('Europe/Istanbul');

try{
    $db = new PDO('mysql:host=localhost;dbname=dbadi;charset=utf8', 'dbkullaniciadi', 'dbsifre');
}catch(PDOException $e){
    die($e->getMessage());
}

foreach(glob(__DIR__ . '/Helpers/*.php') as $helper){
    require $helper;
}