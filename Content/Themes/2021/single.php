<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9 fe-content">
                    <div class="single-page" id="item-<?php echo $item->ID ?>">
                        <!-- Title Start -->
                        <h1 class="article-title"><?php echo Post::Title() ?></h1>
                        <!-- Title End -->

                        <?php if(isset($_SESSION['loggedin'])): ?>
                        <!-- Meta Start -->
                        <nav class="nav meta">
                            <span class="nav-link"><i class="las la-clock"></i><?php echo App::TimeAgo($item->created_at) ?></span>
                            <a href="<?php echo App::Setting('site_url') . 'admin/edit-post/' . $item->ID ?>" class="nav-link"><i class="las la-pen"></i>Yazıyı Düzenle</a>
                            <a href="<?php echo App::Setting('site_url') . 'admin/delete?table=posts&id=' . $item->ID . '&redirect=home' ?>" class="nav-link"><i class="las la-trash"></i>Yazıyı Sil</a>
                        </nav>
                        <!-- Meta End -->                      
                        <?php endif ?>  

                        <!-- Content Start -->
                        <div class="content">
                            <?php echo html_entity_decode(Post::Content()) ?>
                        </div>
                        <!-- Content End -->

                        <!-- Comments Area Start -->
                        <div class="comments-area">
                            <!-- Title Start -->
                            <div class="comments-title">Yorum Yap</div>
                            <!-- Title End -->

                            <!-- Form Start -->
                            <form action="" class="comment-form">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control shadow-none form-expand" name="content" placeholder="Yorum yapın..." id="floatingTextarea2"
                                        style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Yorum</label>
                                </div>
                                <div class="row g-2 d-none input-area" id="input-area">
                                    <div class="col-12 col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-none" name="username" id="floatingInput" placeholder="Ad Soyad">
                                            <label for="floatingInput">Ad Soyad</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-floating">
                                            <input type="email" class="form-control shadow-none" name="email" id="floatingInput" placeholder="E-Posta">
                                            <label for="floatingInput">E-Posta</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <button class="btn w-100">Gönder</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form End -->

                            <!-- Title Start -->
                            <div class="comments-title"><?php echo count(Post::Comments()) ? count(Post::Comments()) . ' Yorum' : 'Yorum Yok' ?></div>
                            <!-- Title End -->                            

                            <!-- Comment List Start -->
                            <ul class="nav comment-list flex-column">
                                <?php foreach(Post::Comments() as $comment): ?>
                                <li class="nav-item">
                                    <div class="comment">
                                        <!-- Avatar Start -->
                                        <img src="<?php echo Post::Avatar($comment->email, 35) ?>" alt="" class="avatar">
                                        <!-- Avatar End -->

                                        <!-- Content Start -->
                                        <div class="comment-main">
                                            <!-- Header Start -->
                                            <div class="header">
                                                <!-- Name Start -->
                                                <div class="name"><?php echo $comment->username ?></div>
                                                <!-- Name End -->

                                                <!-- Date Start -->
                                                <div class="timeago"><?php echo App::TimeAgo($comment->created_at) ?></div>
                                                <!-- Date End -->
                                            </div>
                                            <!-- Header End -->

                                            <!-- Content Start -->
                                            <div class="comment-content">
                                                <?php echo $comment->content ?>
                                            </div>
                                            <!-- Content End -->
                                        </div>
                                        <!-- Content End -->
                                    </div>
                                    <?php if(Post::Replies()): ?>
                                    <div class="reply">
                                        <?php foreach(Post::Replies() as $reply): ?>
                                        <div class="comment">
                                            <!-- Avatar Start -->
                                            <img src="<?php echo Post::AdminAvatar() ?>" alt="" class="avatar">
                                            <!-- Avatar End -->
    
                                            <!-- Content Start -->
                                            <div class="comment-main">
                                                <!-- Header Start -->
                                                <div class="header">
                                                    <!-- Name Start -->
                                                    <div class="name"><?php echo $reply->fullname ?></div>
                                                    <!-- Name End -->
    
                                                    <!-- Date Start -->
                                                    <div class="timeago"><?php echo App::TimeAgo($reply->created_at) ?></div>
                                                    <!-- Date End -->
                                                </div>
                                                <!-- Header End -->
    
                                                <!-- Content Start -->
                                                <div class="comment-content">
                                                    <?php echo $reply->content ?>
                                                </div>
                                                <!-- Content End -->
                                            </div>
                                            <!-- Content End -->
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                    <?php endif ?>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <!-- Comment List End -->
                        </div>
                        <!-- Comments Area End -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>