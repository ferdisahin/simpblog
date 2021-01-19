<?php

$pageTitle = 'Anasayfa';

$count = count(App::Posts());

$limit      = 10;
$total      = $count;
$pages      = ceil($total / $limit);
$page       = isset($_GET['p']) ? $_GET['p'] : 1;
$start      = ($page - 1) * $limit;

$pages      = $pages ? $pages : 1;

if($page > $pages || $page <= 0){
    header('Location:' . App::Setting('site_url'));
}

$posts      = $db->prepare('SELECT * FROM posts ORDER BY ID DESC LIMIT ?,?');
$posts->bindValue(1, $start, PDO::PARAM_INT);
$posts->bindValue(2, $limit, PDO::PARAM_INT);
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_OBJ);

require App::View('index');