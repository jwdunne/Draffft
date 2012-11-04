<?=$meta;?>
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
				<?php //while($article = $db->fassoc($articles)) : ?>
                <?php $article = ['date' => time(), 'title' => 'Article Title', 'description' => 'Article Description', 'body' => 'Article Body']; ?>
				<div class="article-wrapper">
					<div class="article-container clr">
						<h6>Posted on <?=strtoupper(date('dMy Hi:s T', $article['date']));?></h6>
						<h2><a href="<?=URI::make($article['title']);?>"><?=$article['title'];?></a></h2>
						<p><?=$article['description'];?></p>
						<div class="article-preview" style="background:rgb(248, 248, 248); border:1px solid rgb(232, 232, 232); padding:5px;">
							<?=strip_tags(substr($article['body'], 0, 1200), '<br><b><strong><em><a><p>');?>
						</div>
					</div>
				</div>
				<?php //endwhile; ?>
			</div>
		</div>
	</body>
</html>
