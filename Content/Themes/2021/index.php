<?php require App::View('header') ?>
    <!-- MAIN START -->
    <main id="main">
        <div class="container">
            <div class="row">
                <?php require App::View('sidebar') ?>
                <div class="col-12 col-md-9 fe-content">
                    <div class="item-list">
                        <?php foreach($posts as $item): ?>
                        <!-- Article Start -->
                        <div class="article">
                            <!-- Cat Start -->
                            <?php 
                                $exp = explode(',', $item->cat_id);

                                $cat = $db->prepare('SELECT * FROM categories');
                                $cat->execute();
                                $cat = $cat->fetchAll(PDO::FETCH_OBJ);

                                foreach($cat as $c){
                                    if(in_array($c->ID, $exp)){
                                        echo '<a href="'.App::Setting('site_url') . 'category/' . $c->slug.'" class="cat me-2">'.$c->title.'</a>';
                                    }
                                }
                            ?>
                            <!-- Cat End -->
    
                            <!-- Title Start -->
                            <a href="<?php echo Post::Slug() ?>" class="title"><?php echo Post::Title() ?></a>
                            <!-- Title End -->
    
                            <!-- Desc Start -->
                            <div class="desc"><?php echo strip_tags(html_entity_decode(Post::Summary())) . '...' ?></div>
                            <!-- Desc End -->
    
                            <!-- Time Ago Start -->
                            <div class="timeago"><i class="las la-clock"></i><?php echo App::TimeAgo($item->created_at) ?></div>
                            <!-- Time Ago End -->
                        </div>
                        <!-- Article End -->   
                        <?php endforeach ?>              
                    </div>     

                    <?php
                        if($pages > 1){
                            echo Post::PaginationLinks($page, $pages, App::Setting('site_url'));
                        }
                    ?>                    
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN END -->
<?php require App::View('footer') ?>