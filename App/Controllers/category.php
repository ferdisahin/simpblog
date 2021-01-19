<?php

$slug = App::Route(1);

$cat = $db->prepare('SELECT * FROM categories WHERE slug = ?');
$cat->execute([$slug]);
$cat = $cat->fetch(PDO::FETCH_OBJ);

$count = $db->prepare('SELECT * FROM posts WHERE FIND_IN_SET(?, cat_id)');
$count->execute([$cat->ID]);
$count = count($count->fetchAll(PDO::FETCH_OBJ));

$limit      = 10;
$total      = $count;
$pages      = ceil($total / $limit);
$page       = isset($_GET['p']) ? $_GET['p'] : 1;
$start      = ($page - 1) * $limit;

$pages      = $pages ? $pages : 1;

if($page > $pages || $page <= 0){
    header('Location:' . App::Setting('site_url'));
}

$posts      = $db->prepare('SELECT * FROM posts WHERE FIND_IN_SET(?, cat_id) ORDER BY ID DESC LIMIT ?,?');
$posts->bindValue(1, $cat->ID, PDO::PARAM_INT);
$posts->bindValue(2, $start, PDO::PARAM_INT);
$posts->bindValue(3, $limit, PDO::PARAM_INT);
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_OBJ);

$pageTitle = 'Kategori';

require App::View('archive');