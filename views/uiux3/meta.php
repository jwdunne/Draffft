<!DOCTYPE html>
<html>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=$title;?></title>
		<link rel="stylesheet" href="<?=Uri::make('core/assets/css/global.css', false);?>" />
		<?=Application::stylesheet('css/default.css');?>
		
		<link rel="alternate" href="<?=Uri::make('feed/recent.rss');?>" type="application/rss+xml" title="Site feed">
		<link rel="shortcut icon" type="image/png" href="<?=Uri::make('Core/assets/images/favicon.png');?>" />
		<script type="text/javascript">
	    var base_url 	= "<?=Uri::make();?>",
			app_url		= "<?=Uri::make(Application::$name);?>/",
			imageDir 	= "<?=Uri::make('apps', 'public', 'views', 'default', 'images');?>",
			site_name 	= "<?=Settings::read('site_name');?>",
			this_script	= "<?=Uri::make(Uri::current());?>",
			user_id	 	= "<?=Auth::info('id');?>",
			user_name	= "<?=Auth::info('username');?>",
			in_debug	= <?=DEBUG;?>
		<?php ($hook = Hook::hook('view_javascript_globals')) ? eval($hook) : false; ?>
		</script>
		<script src="<?=Uri::make('Core/assets/js/jquery.lib.js', false);?>"></script>
        <script src="<?=Uri::make('Core/assets/js/ready.lib.js', false);?>"></script>
		<script src="<?=Uri::make('Core/assets/js/scmf.lib.js', false);?>"></script>