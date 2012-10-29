<!DOCTYPE html>
<html>
	<head>
		<title><?=$article['title'];?></title>
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
				<h6>Posted on <?=strtoupper(date('dMy Hi:s T', $article['date']));?></h6>
				<h1><?=$article['title'];?></h1>
				<p><?=$article['description'];?></p>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
				<?=$article['body'];?>
			</div>
		</div>
		<div class="push-ups"></div>
	</body>
</html>
