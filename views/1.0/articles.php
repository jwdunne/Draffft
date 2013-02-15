<?=$meta;?>
    </head>
	<body>
		<div class="draffft-title-wrapper">
			<div class="draffft-title-container">
				<h1><?=Settings::read('draffft_name')?></h1>
				<p><?=Settings::read('draffft_slogan');?></p>
				<span>There are <?=Articles::total();?> articles so far.</span>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
			    <?php if (Articles::total() >= 1) : ?>
			        <?php foreach (Articles::get() as $article) : ?>
    				<div class="article-wrapper">
    					<div class="article-container clr">
    						<h6><?=__('common.posted-x', [date('Y-m-d', $article['date']), Time::since($article['date'])]);?></h6>
    						<h2><a href="<?=Article::link($article['id'], $article['title'], true);?>"><?=$article['title'];?></a></h2>
    						<p><?=$article['description'];?></p>
    						<div class="article-preview" style="background:rgb(248, 248, 248); border:1px solid rgb(232, 232, 232); padding:5px;">
    							<?=Article::preview($article['body']);?>
    						</div>
    					</div>
    				</div>
    				<?php endforeach; ?>
    			<?php else : ?>
    			    <div class="article-wrapper">
    					<div class="article-container clr">
    						<h6><?=Time::stamp(time());?></h6>
    						<h2><?=__('common.empty-blog-title', 'An Error Has Occured')?></h2>
    						<div class="article-preview" style="background:rgb(248, 248, 248); border:1px solid rgb(232, 232, 232); padding:5px;">
    						    <p><?=__('common.empty-blog-desc', 'Unfortunately this blog is empty!');?></p>
    						</div>
    					</div>
    				</div>
    			<?php endif; ?>
			</div>
		</div>
	</body>
</html>
