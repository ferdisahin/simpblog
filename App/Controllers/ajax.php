<?php 
if(Form::Security('sendComment')){
    $form = Form::Security('serialize');
    $id = Form::Security('id');
    parse_str(html_entity_decode($form), $comment);
    

    if(!$comment['content'] || !$comment['username'] || !$comment['email']){
        $result['error'] = true;
        $result['text'] = 'Lütfen tüm alanları doldurun!';
    }elseif(!filter_var($comment['email'], FILTER_VALIDATE_EMAIL)){
        $result['error'] = true;
        $result['text'] = 'Lütfen geçerli bir e-posta adresi girin!';
    }elseif(mb_strlen($comment['content']) < 10){
        $result['error'] = true;
        $result['text'] = 'Yorum çok kısa!';        
    }else{
        $add = $db->prepare('INSERT INTO comments (content, post_id, username, email, status) VALUES (?,?,?,?,?)');
        $ok = $add->execute([$comment['content'], $id, $comment['username'], $comment['email'], 2]);
        if($ok){
            $result['success'] = true;
            $result['text']     = 'Tebrikler, yorumunuz başarıyla eklendi. Yönetici onayından sonra sitede görünecektir.';
        }
    }

    echo json_encode([
        'text'  => @$result['text'],
        'error' => @$result['error'],
        'success'   => @$result['success']
    ]);
}

if(Form::Security('login')){
    $form = Form::Security('serialize');
    parse_str(html_entity_decode($form), $login);

    $user = $db->prepare('SELECT * FROM admin WHERE username = ?');
    $user->execute([$login['username']]);
    $user = $user->fetch(PDO::FETCH_OBJ);

    if(!$login['username'] || !$login['password']){
        $result['error'] = true;
        $result['text'] = 'Lütfen tüm alanları doldurun!';
    }elseif(!$user){
        $result['error'] = true;
        $result['text'] = 'Böyle bir üye yok ya da şifre hatalı!';        
    }elseif(!password_verify($login['password'], $user->password)){
        $result['error'] = true;
        $result['text'] = 'Şifreniz hatalı görünüyor!';
    }else{
        $result['success'] = true;
        $result['text'] = 'Tebrikler, başarıyla giriş yaptınız!';

        $_SESSION['loggedin'] = true;
        $_SESSION['ID'] = $user->ID;
    }

    echo json_encode([
        'error' => @$result['error'],
        'text'  => @$result['text'],
        'success' => @$result['success']
    ]);
}
?>