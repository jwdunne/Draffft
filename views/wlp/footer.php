        <footer class="site-footer clr">
            <div class="powered-by">
                <a href="http://soule.devxdev.com">
                    <img src="<?=Application::asset_url('images/soule.png');?>" alt="" />
                </a>
            </div>
            <div class="meta">
                <ol class="clr">
                    <li class="copyright">
                        <h5><?=Settings::read('copyright');?></h5>
                    </li>
                    <ol class="links clr">
                        <li>
                            <a href="<?=Application::link('contact-us');?>">Contact</a>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="<?=Application::link('privacy');?>">Privacy</a>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="<?=Application::link('tos');?>">Terms of Service</a>
                        </li>
                    </ol>
                </ol>
            </div>
        </footer>
        <script src="<?=Uri::make('core', 'assets', 'js', 'scmf-2.js');?>"></script>
    </body>
</html>
