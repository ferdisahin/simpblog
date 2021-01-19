<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="admin-page h-100 d-flex flex-column justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="section-title">Giriş Yap</div>

                        <form action="" class="login">
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control shadow-none" id="floatingInputGrid" placeholder="Kullanıcı Adı">
                                <label for="floatingInputGrid">Kullanıcı Adı</label>
                            </div>                            
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control shadow-none" id="floatingInputGrid" placeholder="Şifre">
                                <label for="floatingInputGrid">Şifre</label>
                            </div>                            
                            <div class="">
                                <button class="send-btn send-login">Giriş Yap</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>