<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9">
                    <div class="admin-page">
                        <div class="section-title">Yeni Yazı Ekle</div>

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

                        <form action="" method="POST" class="new-post">
                            <div class="form-floating mb-3">
                                <input type="text" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : null ?>" class="form-control" id="floatingInputGrid" placeholder="Başlık">
                                <label for="floatingInputGrid">Başlık</label>
                            </div>                            
                            <div class="form-floating mb-3">
                                <div id="editor"><?php echo isset($_POST['content']) ? $_POST['content'] : null ?></div>
                                <textarea id="editor" name="content" class="message-content d-none form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="row g-2">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="cat" class="select select-cat w-100" style="height: 58px">
                                    <style>
                                        .selectize-input {
                                            height: 58px
                                        }
                                    </style>
                                </div>
                                <div class="col-12 col-md-6">
                                    <button name="new-post" class="send-btn">Yazıyı Paylaş</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>