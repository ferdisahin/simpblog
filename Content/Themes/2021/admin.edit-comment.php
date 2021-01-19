<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9">
                    <div class="admin-page">
                        <div class="section-title">Yorumu Düzenle</div>

                        <?php if(isset($result['error'])): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <?php echo $result['error'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>           
                        <?php elseif(isset($result['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $result['success'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                               
                        <?php endif ?>             

                        <form action="" method="POST" class="edit-post">
                            <div class="row">
                                <div class="form-floating col-12 col-md-6 mb-3">
                                    <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : $comment->username ?>" class="form-control" id="floatingInputGrid" placeholder="Başlık">
                                    <label for="floatingInputGrid">Kullanıcı Adı</label>
                                </div>                            
                                <div class="form-floating col-12 col-md-6 mb-3">
                                    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $comment->email ?>" class="form-control" id="floatingInputGrid" placeholder="Başlık">
                                    <label for="floatingInputGrid">E-Posta</label>
                                </div>                            
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control shadow-none" name="content" placeholder="Yorum" id="floatingTextarea" style="height: 150px"><?php echo isset($_POST['content']) ? $_POST['content'] : $comment->content ?></textarea>
                                <label for="floatingTextarea">Yorum</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-none" name="status" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Durum Seçin</option>
                                    <option value="1" <?php echo $comment->status == 1 ? 'selected' : @$_POST['status'] ?>>Aktif</option>
                                    <option value="2" <?php echo $comment->status == 2 ? 'selected' : @$_POST['status'] ?>>Pasif</option>
                                </select>
                                <label for="floatingSelect">Durum</label>
                            </div>                            
                            <div>
                                <button name="editComment" class="send-btn">Yorumu Düzenle</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>