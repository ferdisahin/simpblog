<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo App::Title() ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo Theme::template_path('assets/css/main.min.css') ?>">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <?php if(App::Route(0) == 'admin'): ?>
    <link href="<?php echo Theme::template_path('assets/plugins/select/css/selectize.css') ?>" rel="stylesheet" />
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Theme::template_path('assets/plugins/editor/quill.imageUploader.min.css') ?>">
    <?php endif ?>
</head>
<body data-url="<?php echo App::Setting('site_url') ?>">
    <!-- HEADER START -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo App::Setting('site_url') ?>">
                <?php echo App::Setting('site_title') ?>
                <span class="text">Blog</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarSupportedContent">
                <form class="d-flex search-form ms-md-5 mb-3 mb-md-0" action="<?php echo App::Setting('site_url') . 'search' ?>" method="GET">
                    <input class="form-control me-2 shadow-none" name="s" type="search" placeholder="Arama yap..." aria-label="Search">
                    <button class="btn" type="submit"><i class="las la-search"></i></button>
                </form>       
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo App::Route(1) == '' ? 'active' : null ?>" aria-current="page" href="<?php echo App::Setting('site_url') ?>">Anasayfa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- HEADER END -->