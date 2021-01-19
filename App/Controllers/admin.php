<?php

if(!isset($_SESSION['loggedin'])){
    header('Location:' . App::Setting('site_url'));
    die;
}

if(App::Route(1) == 'new-post'){
    $pageTitle = 'Yazı Ekle';

    if(isset($_POST['new-post'])){
        $form['title']      = Form::Security('title');
        $form['content']    = Form::Security('content');
        $form['cat']        = Form::Security('cat');
        $form['slug']       = App::Slugify($form['title']);
        $form['summary']    = mb_substr(Form::Security('content'),0,200);

        if(!$form['title'] || !$form['content'] || !$form['cat']){
            $result['error'] = '<strong>Uyarı</strong> Lütfen tüm alanları doldurun!';
        }else{
            $max = $db->prepare('SELECT MAX(ID) as id FROM posts');
            $max->execute();
            $max = $max->fetch(PDO::FETCH_OBJ);
            $max = $max->id == NULL ? 1 : $max->id;
            $form['slug']   = $form['slug'] . '-' . $max;

            $add = $db->prepare('INSERT INTO posts (title,slug,summary,content,cat_id) VALUES (?,?,?,?,?)');
            $ok = $add->execute([$form['title'], $form['slug'], $form['summary'], $form['content'], $form['cat']]);
            if($ok){
                $result['success'] = '<strong>Tebrikler</strong> Yazı başarıyla eklendi!';
                header('Refresh:3; url=' . App::Setting('site_url') . '/admin/new-post');
            }
        }
    }

    require App::View('admin.new-post');
    die;
}elseif(App::Route(1) == 'edit-post'){
    $pageTitle = 'Yazıyı Düzenle';

    $id = App::Route(2);

    $post = $db->prepare('SELECT * FROM posts WHERE ID = ?');
    $post->execute([$id]);
    $item = $post->fetch(PDO::FETCH_OBJ);

    if(!$item){
        $pageTitle = 'Hata';
        require App::View('404');
        die;
    }

    if(isset($_POST['edit-post'])){
        $form['title']      = Form::Security('title');
        $form['content']    = Form::Security('content');
        $form['cat']        = Form::Security('cat');
        $form['summary']    = mb_substr(Form::Security('content'),0,200);

        if(!$form['title'] || !$form['content'] || !$form['cat']){
            $result['error'] = '<strong>Uyarı</strong> Lütfen tüm alanları doldurun!';
        }else{
            $add = $db->prepare('UPDATE posts SET title = ?, summary = ?, content = ?, cat_id = ? WHERE ID = ?');
            $ok = $add->execute([$form['title'], $form['summary'], $form['content'], $form['cat'], $id]);
            if($ok){
                $result['success'] = '<strong>Tebrikler</strong> Yazı başarıyla düzenlendi!';
            }
        }        
    }

    require App::View('admin.edit-post');
}elseif(App::Route(1) == 'settings'){
    $pageTitle = 'Ayarlar';

    if(isset($_POST['updateSettings'])){
        $form['site_title']  = Form::Security('site_title');
        $form['site_desc']   = Form::Security('site_desc');
        $form['instagram']      = Form::Security('instagram');
        $form['linkedin']      = Form::Security('linkedin');

        if(!$form['site_title'] || !$form['site_desc']){
            $result['error'] = 'Lütfen tüm alanları doldurun!';
        }else{
            $arr = ['site_title', 'site_desc', 'instagram', 'linkedin'];

            foreach($arr as $update){
                $upd = $db->prepare("UPDATE settings SET value = ? WHERE name = ?");
                $ok = $upd->execute([$form[$update], $update]);
            }

            if($ok){
                $result['success'] = 'Tebrikler, ayarlar başarıyla güncellendi!';
            }
        }
    }

    require App::View('admin.settings');
}elseif(App::Route(1) == 'categories'){
    $pageTitle = 'Kategoriler';

    // Categories
    $count = count(App::Categories());

    $limit      = 10;
    $total      = $count;
    $pages      = ceil($total / $limit);
    $page      = isset($_GET['p']) ? $_GET['p'] : 1;
    $start      = ($page - 1) * $limit;

    $pages      = $pages ? $pages : 1;

    if($page > $pages || $page <= 0){
        header('Location:' . App::Setting('site_url') . 'admin/categories');
    }

    $catList = $db->prepare('SELECT * FROM categories ORDER BY title ASC LIMIT ?,?');
    $catList->bindValue(1, $start, PDO::PARAM_INT);
    $catList->bindValue(2, $limit, PDO::PARAM_INT);
    $catList->execute();
    $catList = $catList->fetchAll(PDO::FETCH_OBJ);    

    if(isset($_POST['addCategory'])){
        $form['title']  = Form::Security('title');
        $form['icon']   = Form::Security('icon');
        $form['slug']   = App::Slugify($form['title']);

        if(!$form['title']){
            $result['error'] = 'Lütfen başlık girin!';
        }else{
            $exs = $db->prepare('SELECT * FROM categories WHERE title = ?');
            $exs->execute([$form['title']]);
            $exs = $exs->fetch(PDO::FETCH_OBJ);

            if($exs){
                $result['error'] = 'Bu kategori zaten mevcut, tekrar eklenemez!';
            }else{
                $add = $db->prepare('INSERT INTO categories (title, slug, icon) VALUES (?,?,?)');
                $ok = $add->execute([$form['title'], $form['slug'], $form['icon']]);
                if($ok){
                    $result['success'] = 'Kategori başarıyla eklendi!';
                    //header('Refresh: 2; url=' . App::Setting('site_url') . 'admin/categories');
                }
            }

        }
    }

    require App::View('admin.categories');
}elseif(App::Route(1) == 'delete'){
    $id     = $_GET['id'];
    $table  = $_GET['table']; 
    $redirect = $_GET['redirect'];

    if(!$id || !$table){
        header('Location:' . App::Setting('site_url') . 'admin/categories');
    }

    $delete = $db->prepare("DELETE FROM $table WHERE ID = ?");
    $ok = $delete->execute([$id]);

    if($ok){
        if($redirect){
            header('Location:' . App::Setting('site_url'));
        }else{
            header('Location:' . App::Setting('site_url') . 'admin/' . $table);
        }
    }

}elseif(App::Route(1) == 'edit-category'){
    $id = App::Route(2);

    $pageTitle = 'Kategoriyi Düzenle';

    // Categories
    $count = count(App::Categories());

    $limit      = 10;
    $total      = $count;
    $pages      = ceil($total / $limit);
    $page      = isset($_GET['p']) ? $_GET['p'] : 1;
    $start      = ($page - 1) * $limit;

    $pages      = $pages ? $pages : 1;

    if($page > $pages || $page <= 0){
        header('Location:' . App::Setting('site_url') . 'admin/categories');
    }

    $catList = $db->prepare('SELECT * FROM categories ORDER BY title ASC LIMIT ?,?');
    $catList->bindValue(1, $start, PDO::PARAM_INT);
    $catList->bindValue(2, $limit, PDO::PARAM_INT);
    $catList->execute();
    $catList = $catList->fetchAll(PDO::FETCH_OBJ);        

    $cat = $db->prepare('SELECT * FROM categories WHERE ID = ?');
    $cat->execute([$id]);
    $item = $cat->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['editCategory'])){
        $form['title']  = Form::Security('title');
        $form['icon']   = Form::Security('icon');

        if(!$form['title']){
            $result['error'] = 'Lütfen başlık girin!';
        }else{
            $add = $db->prepare('UPDATE categories SET title = ?, icon = ? WHERE ID = ?');
            $ok = $add->execute([$form['title'], $form['icon'], $id]);
            if($ok){
                $result['success'] = 'Kategori başarıyla eklendi!';
                header('Refresh:2; url=' . App::Setting('site_url') . 'admin/edit-category/' . $id);
            }
        }
    }  

    require App::View('admin.edit-category');
    die;
}elseif(App::Route(1) == 'comments'){
    $pageTitle = 'Yorumlar';

    $count = $db->prepare('SELECT * FROM comments');
    $count->execute();
    $count = $count->fetchAll(PDO::FETCH_OBJ);

    $limit      = 10;
    $total      = count($count);
    $pages      = ceil($total / $limit);
    $page       = isset($_GET['p']) ? $_GET['p'] : 1;
    $start      = ($page - 1) * $limit;

    $pages      = $pages ? $pages : 1;

    if($page > $pages || $page <= 0){
        header('Location:' . App::Setting('site_url') . 'admin/comments');
    }

    $commList = $db->prepare('SELECT *, 
    comments.content as commcontent,
    posts.title as ptitle,
    posts.slug as pslug,
    comments.ID as cid
    FROM comments 
    INNER JOIN posts ON posts.ID = comments.post_id
    ORDER BY posts.ID DESC LIMIT ?,?');
    $commList->bindValue(1, $start, PDO::PARAM_INT);
    $commList->bindValue(2, $limit, PDO::PARAM_INT);
    $commList->execute();
    $commList = $commList->fetchAll(PDO::FETCH_OBJ);

    require App::View('admin.comments');
}elseif(App::Route(1) == 'edit-comment'){
    $pageTitle = 'Yorumu Düzenle';

    $id = App::Route(2);

    $comment = $db->prepare('SELECT * FROM comments WHERE ID = ?');
    $comment->execute([$id]);
    $comment = $comment->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['editComment'])){
        $form['username']   =   Form::Security('username');
        $form['email']      =   Form::Security('email');
        $form['content']    =   Form::Security('content');
        $form['status']     =   Form::Security('status');

        if(!$form['username'] || !$form['email'] || !$form['content']){
            $result['error'] = 'Lütfen tüm alanları doldurun!';
        }else{
            $update = $db->prepare('UPDATE comments SET username =?, email = ?, content = ?, status = ? WHERE ID = ?');
            $ok = $update->execute([$form['username'], $form['email'], $form['content'], $form['status'], $id]);
            if($ok){
                $result['success']  = 'Tebrikler, yorum başarıyla düzenlendi!';
                header('Refresh: 2; url=' . App::Setting('site_url') . 'admin/comments');
            }
        }
    }

    require App::View('admin.edit-comment');
}elseif(App::Route(1) == 'add-reply'){
    $pageTitle = 'Cevap Ekle';
    $id = App::Route(2);

    $exs = $db->prepare('SELECT * FROM comments WHERE ID = ?');
    $exs->execute([$id]);
    $exs = $exs->fetch(PDO::FETCH_OBJ);

    if(!$exs){
        header('Location:' . App::Setting('site_url') . 'admin/comments');
    }

    if(isset($_POST['addReply'])){
        $content    = Form::Security('content');
        $user_id    = $_SESSION['ID'];

        if(!$content){
            $result['error'] = 'Lütfen yorum alanını doldurun!';
        }else{
            $add = $db->prepare('INSERT INTO replies (comment_id, content, user_id) VALUES (?,?,?)');
            $ok = $add->execute([$id, $content, $user_id]);
            if($ok){
                $result['success'] = 'Tebrikler, cevap başarıyla eklendi!';
                header('Refresh: 2; url=' . App::Setting('site_url') . 'admin/comments');                
            }
        }
    }

    require App::View('admin.add-reply');
}elseif(App::Route(1) == 'logout'){
    session_destroy();
    header('Location:' . App::Setting('site_url'));
    die;
}elseif(App::Route(1) == ''){
    header('Location:' . App::Setting('site_url') . 'admin/settings');
}else{
    $pageTitle = 'Hata';
    require App::View('404');
    die;
}