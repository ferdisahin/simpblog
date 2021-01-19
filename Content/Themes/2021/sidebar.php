<div class="col-12 col-md-3 d-none d-md-flex sidebar-area">
    <nav class="nav menu flex-column">
        <?php foreach(App::Categories() as $cat): ?>
        <a href="<?php echo App::Setting('site_url') . 'category/' . $cat->slug ?>" class="nav-link <?php echo App::Route(1) == $cat->slug ? 'active' : null  ?>">
            <span class="icon-box">
                <i class="<?php echo $cat->icon ?>" class="icon"></i>
            </span>
            <?php echo $cat->title ?>
        </a>
        <?php endforeach ?>
    </nav>

    <?php if(isset($_SESSION['loggedin'])): ?>
    <nav class="menu flex-column mt-auto mb-3">
        <a href="<?php echo App::Setting('site_url') . 'admin/new-post' ?>" class="nav-link <?php echo App::Route(1) == 'new-post' ? 'active' : null ?>">
            <span class="icon-box">
                <i class="las la-pencil-alt"></i>
            </span>
            Yazı Ekle
        </a>
        <a href="<?php echo App::Setting('site_url') . 'admin/categories' ?>" class="nav-link <?php echo App::Route(1) == 'categories' ? 'active' : null ?>">
            <span class="icon-box">
                <i class="las la-tags"></i>
            </span>
            Kategoriler
        </a>
        <a href="<?php echo App::Setting('site_url') . 'admin/comments' ?>" class="nav-link <?php echo App::Route(1) == 'comments' ? 'active' : null ?>">
            <span class="icon-box">
                <i class="las la-comments"></i>
            </span>
            Yorumlar
            <?php if(App::CommentCount()): ?>
            <span class="badge ms-auto"><?php echo App::CommentCount() ?></span>
            <?php endif ?>
        </a>                        
        <a href="<?php echo App::Setting('site_url') . 'admin/settings' ?>" class="nav-link <?php echo App::Route(1) == 'settings' ? 'active' : null ?>">
            <span class="icon-box">
                <i class="las la-cog"></i>
            </span>
            Site Ayarları
        </a>
        <a href="<?php echo App::Setting('site_url') . 'admin/logout' ?>" class="nav-link">
            <span class="icon-box">
            <i class="las la-sign-out-alt"></i>
            </span>
            Çıkış Yap
        </a>
    </nav>
    <?php endif ?>
</div>