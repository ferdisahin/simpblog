<?php

$pageTitle = 'Arama';

$search = $_GET['s'];
$search = '%' . $search . '%';

$count = $db->prepare('SELECT * FROM posts WHERE title LIKE ?');
$count->execute([$search]);
$count = $count->fetchAll(PDO::FETCH_OBJ);

$limit      = 10;
$total      = count($count);
$pages      = ceil($total / $limit);
$page       = isset($_GET['p']) ? $_GET['p'] : 1;
$start      = ($page - 1) * $limit;

$pages      = $pages ? $pages : 1;

if($page > $pages || $page <= 0){
    header('Location:' . App::Setting('site_url'));
}

$posts = $db->prepare('SELECT * FROM posts WHERE title LIKE ? ORDER BY ID DESC LIMIT ?,?');
$posts->bindValue(1, $search, PDO::PARAM_STR);
$posts->bindValue(2, $start, PDO::PARAM_INT);
$posts->bindValue(3, $limit, PDO::PARAM_INT);
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_OBJ);

require App::View('archive');