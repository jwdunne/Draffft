<?=$meta;?>
	</head>
	<body>
		<div class="draffft-title-wrapper">
			<div class="draffft-title-container">
				<h6><?=__('common.posted-x', [date('Y-m-d', $article['date']), Time::since($article['date'])]);?></h6>
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
