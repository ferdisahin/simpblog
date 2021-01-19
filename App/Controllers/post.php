<?php

$slug = App::Route(1);

$post = $db->prepare('SELECT * FROM posts WHERE slug = ?');
$post->execute([$slug]);
$item = $post->fetch(PDO::FETCH_OBJ);

if(!$item){
    $pageTitle = 'HATA!';
    require App::View('404');
    die;
}

$pageTitle = $item->title;

require App::View('single');