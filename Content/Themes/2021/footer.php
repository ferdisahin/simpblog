    <!-- FOOTER START -->
    <footer id="footer" class="pt-5 mt-auto pb-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-3">
                    <nav class="nav social justify-content-center mb-3 mb-md-0">
                        <a href="#" class="nav-link"><i class="lab la-instagram"></i></a>
                        <a href="#" class="nav-link"><i class="lab la-linkedin-in"></i></a>
                    </nav>
                </div>
                <div class="col-12 col-md-9">
                    <p class="text-center copyright"><?php echo App::Setting('site_title') ?> &copy; 2020. Tüm hakları saklıdır.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php if(App::Route(0) == 'admin'): ?>
    
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="<?php echo Theme::template_path('assets/plugins/editor/quill.imageUploader.min.js') ?>"></script>
    <script src="<?php echo Theme::template_path('assets/plugins/select/js/standalone/selectize.js') ?>"></script>
    <script>
        $(function(){
            $('.select-cat').selectize({
                delimiter: ',',
                maxItems: null,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                options: [
                    <?php foreach(App::Categories() as $cat): ?>
                    {id: <?php echo $cat->ID ?>, title: '<?php echo $cat->title ?>'},
                    <?php endforeach ?>
                ],
                create: false                
            });              
        });      
    </script>
    <?php endif ?>
    <script src="<?php echo Theme::template_path('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo Theme::template_path('assets/js/main.js') ?>"></script>
</body>
</html>