<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9">
                    <div class="admin-page">
                        <div class="section-title">Kategoriler</div>

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

                        <div class="row">
                            <div class="col-12 col-md-5">
                                <form action="" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title" class="form-control shadow-none" id="floatingInput" placeholder="Kategori Adı" value="<?php echo isset($_POST['title']) ? $_POST['title'] : $item->title ?>">
                                        <label for="floatingInput">Kategori Adı</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="icon" class="form-control shadow-none" id="floatingPassword" placeholder="Kategori İkonu" value="<?php echo isset($_POST['icon']) ? $_POST['icon'] : $item->icon ?>">
                                        <label for="floatingPassword">Kategori İkonu</label>
                                    </div>
                                    <div class="form-group">
                                        <button name="editCategory" class="send-btn">Kategoriyi Düzenle</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-7">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th class="w-60" scope="col">Kategori Adı</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($catList as $cat): ?>
                                        <tr>
                                            <td class="w-60"><a class="text-dark link" href="<?php echo App::Setting('site_url') . 'admin/edit-category/' . $cat->ID ?>"><?php echo $cat->title ?></a></td>
                                            <td>
                                                <a href="<?php echo App::Setting('site_url') . 'admin/edit-category/' . $cat->ID ?>" class="btn btn-sm">Düzenle</a>
                                                <a href="<?php echo App::Setting('site_url') . 'admin/delete?table=categories&id=' . $cat->ID ?>" class="btn btn-sm delete">Sil</a>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php if($pages > 1): ?>
                                        <tr>
                                            <td colspan="2">
                                                <?php
                                                        echo Post::PaginationLinks($page, $pages, App::Setting('site_url') . 'admin/categories');
                                                ?>                                                  
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>