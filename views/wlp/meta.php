<!DOCTYPE html>
<html>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=$title;?></title>
		<link rel="stylesheet" href="<?=Uri::make('core', 'assets', 'css', 'global.css');?>" />
		<?=Application::stylesheet('http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600|Source+Code+Pro:300');?>
		<?=Application::stylesheet('css/default.css');?>
		<?=Application::stylesheet('css/queries.css');?>
		
		<link rel="alternate" href="<?=Application::link('feed', 'recent.rss');?>" type="application/rss+xml" title="Site feed">
		<link rel="shortcut icon" type="image/png" href="<?=Uri::make('core', 'assets', 'images', 'favicon.png');?>" />
		<script type="text/javascript">
	    var base_url 	= "<?=Uri::make();?>",
			app_url		= "<?=Uri::make(Application::$name);?>/",
			imageDir 	= "<?=Uri::make('core', 'assets', 'images');?>",
			site_name 	= "<?=Settings::read('site_name');?>",
			this_script	= "<?=Uri::make(Uri::current());?>",
			user_id	 	= <?=Auth::info('id');?>,
			user_name	= "<?=Auth::info('username');?>",
			in_debug	= <?=DEBUG;?>
		<?php ($hook = Hook::hook('view_javascript_globals')) ? eval($hook) : false; ?>
		</script>
		<script src="<?=Uri::make('core', 'assets', 'js', 'jquery.lib.js');?>"></script>
        <script src="<?=Uri::make('core', 'assets', 'js', 'ready.lib.js');?>"></script>
		<script src="<?=Uri::make('core', 'assets', 'js', 'scmf.lib.js');?>"></script>
		<?=(isset($meta_vars) ? implode(PHP_EOL, $meta_vars) : false);?>
    </head>
    <body>
        <header class="site-header">
            <div class="header-image-container">
                <a href="<?=Application::link('home', 'page', 1);?>">
                    <img class="header-image" src="<?=Uri::make('core/assets/images/ilp-logo.png');?>" alt="ILP Logo">
                </a>
            </div>
            <nav>
                <ul class="nav-links-wrapper clr">
                    <li class="nav-links-container">
                        <a class="nav-link" href="<?=Application::link('home', 'page', 1);?>">home</a>
                    </li>
                    <li class="nav-links-container">
                        <a class="nav-link" href="<?=Application::link('category', '1-Tutorials');?>">tutorials</a>
                    </li>
                    <li class="nav-links-container">
                        <a class="nav-link" target="_blank" title="Opens in new page." href="http://www.facebook.com/weloveprogramming">community</a>
                    </li>
                    <li class="nav-links-container">
                        <a class="nav-link" href="<?=Application::link('about-us');?>">about us</a>
                    </li>
                    <li class="nav-links-container">
                        <a class="nav-link" href="<?=Application::link('contact-us');?>">contact us</a>
                    </li>
                </ul>
            </nav>
        </header>
