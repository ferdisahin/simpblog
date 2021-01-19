<?php require App::View('header') ?>

    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>

                <div class="col-12 col-md-9">
                    <div class="admin-page">
                        <div class="section-title">Yorumlar</div>

                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">Ad Soyad</th>
                                    <th scope="col">Yorum</th>
                                    <th scope="col">Konu</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($commList as $comment): ?>
                                <tr>
                                    <td>
                                        <a class="text-dark link" href="#"><?php echo $comment->username ?></a>
                                    </td>
                                    <td>
                                        <p class="par">
                                            <?php echo $comment->commcontent ?>
                                        </p>
                                    </td>
                                    <td>
                                        <a class="text-dark link" href="<?php echo App::Setting('site_url') . 'post/' . $comment->pslug ?>"><?php echo $comment->ptitle ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo App::Setting('site_url') . 'admin/add-reply/' . $comment->cid ?>" class="btn btn-sm"><i class="las la-plus"></i></a>
                                        <a href="<?php echo App::Setting('site_url') . 'admin/edit-comment/' . $comment->cid ?>" class="btn btn-sm"><i class="las la-edit"></i></a>
                                        <a href="<?php echo App::Setting('site_url') . 'admin/delete?table=comments&id=' . $comment->cid ?>" class="btn btn-sm delete"><i class="las la-times"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php if($pages > 1): ?>
                                <tr>
                                    <td colspan="4">
                                        <?php
                                                echo Post::PaginationLinks($page, $pages, App::Setting('site_url') . 'admin/comments');
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
    </main>
    <!-- MAIN END -->

<?php require App::View('footer') ?>