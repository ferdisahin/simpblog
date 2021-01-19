<?php

$pageTitle = 'Giriş Yap';

if(isset($_SESSION['loggedin'])){
    header('Location:' . App::Setting('site_url'));
}

require App::View('login');