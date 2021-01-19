<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9">
                    <div class="admin-page">
                        <div class="section-title">Site Ayarları</div>

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

                        <form action="" class="new-post" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" name="site_title" class="form-control shadow-none" id="floatingInputGrid" placeholder="Site Başlık" value="<?php echo isset($_POST['site_title']) ? $_POST['site_title'] : App::Setting('site_title') ?>">
                                <label for="floatingInputGrid">Site Başlık</label>
                            </div>                            
                            <div class="form-floating mb-3">
                                <input type="text" name="site_desc" class="form-control shadow-none" id="floatingInputGrid" placeholder="Site Açıklama" value="<?php echo isset($_POST['site_desc']) ? $_POST['site_desc'] : App::Setting('site_desc') ?>">
                                <label for="floatingInputGrid">Site Açıklama</label>
                            </div>                            
                            <div class="row g-2">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="instagram" class="form-control shadow-none" id="floatingInputGrid" placeholder="Instagram" value="<?php echo isset($_POST['instagram']) ? $_POST['instagram'] : App::Setting('instagram') ?>">
                                        <label for="floatingInputGrid">Instagram</label>
                                    </div>    
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="linkedin" class="form-control shadow-none" id="floatingInputGrid" placeholder="Linkedin" value="<?php echo isset($_POST['linkedin']) ? $_POST['linkedin'] : App::Setting('linkedin') ?>">
                                        <label for="floatingInputGrid">Linkedin</label>
                                    </div>    
                                </div>
                                <div class="col-12 col-md-12">
                                    <button name="updateSettings" class="send-btn">Güncelle</button>
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