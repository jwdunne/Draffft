<!DOCTYPE html>
<html>
	<head>
		<title>Articles On Draffft</title>
		<link rel="stylesheet" type="text/css" href="http://soule/applications/public/views/default/css/global.css" />
		<script type="text/javascript">
			var base_url = "http://soule/",
			app_url		 = "http://soule/campr/",
			imageDir 	 = "http://soule/applications/public/views/default/images",
			site_name 	 = "Soule CMF Build 0.1.1.0",
			this_script	 = "http://soule/campr",
			user_id	 	 = "1",
			user_name	 = "devxdev",
			in_debug	 = 1;
		</script>
		<script src="http://soule/applications/public/views/default/js/jquery.lib.js" type="text/javascript"></script>
		<script src="http://soule/applications/public/views/default/js/scmf.lib.js" type="text/javascript"></script>
		<script src="http://soule/applications/public/views/default/js/ready.lib.js" type="text/javascript"></script>
		<link href="<?=$uri->anchor('views', 'default', 'css', 'default.css');?>" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="draffft-title-wrapper">
			<div class="draffft-title-container">
				<h1>Welcome to Draffft</h1>
				<p>Slipstream/Lightweight Blogging Software</p>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
				<?php while($article = $db->fassoc($articles)) { ?>
				<div class="article-wrapper">
					<div class="article-container clr">
						<h6>Posted on <?=strtoupper(date('dMy Hi:s T', $article['date']));?></h6>
						<h2><a href="<?=$uri->create_slug($article['title']);?>"><?=$article['title'];?></a></h2>
						<p><?=$article['description'];?></p>
						<div class="article-preview" style="background:rgb(248, 248, 248); border:1px solid rgb(232, 232, 232); padding:5px;">
							<?=strip_tags(substr($article['body'], 0, 1200), '<br><b><strong><em><a><p>');?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</body>
</html>
