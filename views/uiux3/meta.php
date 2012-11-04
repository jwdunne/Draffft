<!DOCTYPE html>
<html>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=$title;?></title>
		<link rel="stylesheet" href="<?=URI::make('assets/css/global.css', false);?>" />
		<?=Application::stylesheet('css/default.css');?>
		
		<link rel="alternate" href="<?=URI::make('feed/news.rss');?>" type="application/rss+xml" title="Site feed">
		<link rel="shortcut icon" type="image/png" href="<?=URI::make('/assets/images/favicon.png');?>" />
		<script type="text/javascript">
	    var base_url 	= "<?=URI::make();?>",
			app_url		= "<?=URI::make(Application::$name);?>/",
			imageDir 	= "<?=URI::make('apps', 'public', 'views', 'default', 'images');?>",
			site_name 	= "<?=Settings::read('site_name');?>",
			this_script	= "<?=URI::make(URI::current());?>",
			user_id	 	= "<?=Auth::get_user_info('id');?>",
			user_name	= "<?=Auth::get_user_info('username');?>",
			in_debug	= <?=DEBUG;?>
		<?php ($hook = Hook::hook('view_javascript_globals')) ? eval($hook) : false; ?>
		</script>
		<script src="<?=URI::make('assets/js/jquery.lib.js', false);?>"></script>
        <script src="<?=URI::make('assets/js/ready.lib.js', false);?>"></script>
		<script src="<?=URI::make('assets/js/scmf.lib.js', false);?>"></script>