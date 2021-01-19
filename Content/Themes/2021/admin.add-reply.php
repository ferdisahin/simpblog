<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9">
                    <div class="admin-page">
                        <div class="section-title">Cevap Ekle</div>

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
                            <div class="form-floating mb-3">
                                <textarea class="form-control shadow-none" name="content" placeholder="Cevap" id="floatingTextarea" style="height: 150px"><?php echo isset($_POST['content']) ? $_POST['content'] : null ?></textarea>
                                <label for="floatingTextarea">Cevap</label>
                            </div>                      
                            <div>
                                <button name="addReply" class="send-btn">Cevap Ekle</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>