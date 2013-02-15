<?=$meta;?>
        <script type="text/javascript">
		$(d).ready(function() {
			$('.view-this-article').each(function() {

				$('h2', this).css({
					margin:		'0px',
					position:	'relative',
					top:		dead_center('.article-preview', $(this))
				});

				$(this).click(function() {
					window.location = $(this).parents('.article-container').find('.article-link').attr('href');
				});

				;
				
			});
		});
		</script>
	</head>
	<body>
		<div class="draffft-title-wrapper">
			<div class="draffft-title-container clr">
				<?php if (Auth::can('draffft_post_article') || Auth::can('admin')) : ?>
					<div class="fr draffft-new-button-container">
						<a href="<?=Uri::make('new');?>" class="sf-uix-button color-blue">New Article</a>
					</div>
				<?php endif;?>
				<h1><?=Application::info('public_name');?></h1>
				<p><?=Application::info('tagline');?></p>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
				<?php if (Articles::total() >= 1) : ?>
			        <?php foreach (Articles::get() as $article) : ?>
					<div class="article-wrapper">
						<div class="article-container">
							<div class="article-meta clr">
								<h6>
									<span><i class="icon-time"></i><?=__('common.posted', 'Posted')?> <?=Time::since($article['date']);?></span>
									<span><i class="icon-user"></i><?=__('common.posted-by', User::find((int)$article['user_id'], 'username'));?></span>
									<span>
										<i class="icon-comment"></i>
										<a href="<?=Article::link($article['id'], $article['slug']);?>#comments"><?=__('common.x-comments', Comments::count((int)$article['id']));?></a>
									</span>
								</h6>
								<div class="article-title-n-description">
									<h2>
									    <a class="article-link" href="<?=Article::link($article['id'], $article['slug']);?>"><?=$article['title'];?></a>
									</h2>
									<h3><?=$article['description'];?></h3>
								</div>
							</div>
							<div class="article-preview">
								<div class="view-this-article"><h2>Read Article</h2></div>
									<div class="preview-copy">
										<?=Article::preview($article['body'], 500);?>
									</div>
							</div>
						</div>
					</div>
				<?php
					endforeach;
				else : ?>
				<div class="article-wrapper">
					<div class="article-container">
						<div class="article-meta" style="margin:0px auto; text-align:center;">
							<h2 style="font-size:24px; color:rgb(148, 148, 148);"><?=__('common.empty-blog-title', 'An Error Has Occured');?></h2>
							<h4 style="font-size:14px; color:rgb(148, 148, 148);"><?=__('common.empty-blog-desc', 'This could be an error, but we cannot find anything here.');?></h4>
						</div>
					</div>
				</div>
				<?php endif;?>
			</div>
		</div>