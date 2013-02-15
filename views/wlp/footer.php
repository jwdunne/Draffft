        <footer class="site-footer clr">
            <div class="powered-by">
                <img src="<?=Application::asset_url('images/soule.png');?>" alt="" />
            </div>
            <div class="meta">
                <ol class="clr">
                    <li class="copyright">
                        <h5><?=Settings::read('copyright');?></h5>
                    </li>
                    <ol class="links clr">
                        <li>
                            <a href="">Contact</a>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="">Privacy</a>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="">Terms of Service</a>
                        </li>
                    </ol>
                </ol>
            </div>
        </footer>
        <script src="<?=Uri::make('core', 'assets', 'js', 'scmf-2.js');?>"></script>
        <script>
        $(d).ready(function() {
            $('.header-image').css({
                position: 'relative',
                top:      SCMF.position.verticalCenter('.header-image', '.header-image-container'),
                margin:   '0 5%'
            });
        });
        </script>
    </body>
</html>
