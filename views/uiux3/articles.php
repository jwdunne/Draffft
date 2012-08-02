<?php require_once $public->render('meta'); ?>
		<?=$application->stylesheet();?>
		<script type="text/javascript">
		$(d).ready(function() {
			function pos_btns() {
				$('.article-view-button-container').each(function() {
	
					$(this).css({
						position:	'relative',
						top:		dead_center('.article-content-hovered-container', $(this))
					});
					
				});
			}
			
			$('.article-wrapper').hover(function() {
				link_title 	= $('.article-link', this).text();
				date		= $('.article-header-date', this).text();
				
				$('.article-content-hovered-container', this).stop(false, true).fadeIn('slow');
				pos_btns();
				$('.article-link', this).text($('.article-link', this).attr('data-desc'));

				$('.article-view-button', this).click(function() {
					window.location = $(this).attr('data-url');
				});
				
			}, function() {
				$('.article-content-hovered-container', this).stop(false, true).fadeOut('fast');

				
				$('.article-link', this).text(link_title);
			});

			$('.close-admin-bar').click(function() {
				$('.draffft-new-article-container').fadeOut('slow');
			});

			$('.article-quick-actions a').hover(function() {
				$('.sprite-hover', this).stop(true, true).fadeIn('slow');
			}, function() {
				$('.sprite-hover', this).stop(true, true).fadeOut('slow');
			});
			
		});
		</script>
	</head>
	<body>
	<?php require_once $public->render('header'); ?>
		<div class="page-wrapper articles">
			<div class="draffft-title-wrapper">
				<div class="draffft-title-container clr">
					<h1><?=$core->settings('draffft_name');?></h1>
					<p><?=$core->settings('draffft_slogan');?></p>
				</div>
			</div>
			
			<?php if($auth->can('draffft_post_article')) : ?>
			<div class="draffft-new-article-container clr">
				<span>Author Controls</span>
				<div class="draffft-new-button-container">
					<a href="<?=$uri->create_uri($uri->get_slug(0), 'new');?>" class="sf-uix-button color-android">New Article</a>
					<a href="<?=$uri->create_uri('admincp', 'draffft');?>" class="sf-uix-button color-blue">Edit Articles</a>
					<button class="sf-uix-button smaller close-admin-bar">&times;</button>
				</div>
			</div>
			<?php endif;?>
		
			<div class="page-container">
				<?php
				if($model->total_articles() !== 0) :
					while($article 	= $db->fassoc($articles)) :
						$author		= $auth->get_user((int)$article['user_id']);
				?>
				<div class="article-wrapper">
					<div class="article-container">
						<div class="article-header-container clr">
							<i class="article-header-icon dsprite pencil"></i>
							<h2 class="article-header-title">
								<a class="article-link" href="<?=$uri->create_uri($uri->get_slug(0), $article['slug']);?>" data-desc="<?=$article['description']?>"><?=$article['title'];?></a>
							</h2>
							<h4 class="article-header-date"><?=(time_since($article['date']));?></h4>
							<i class="article-header-time-icon dsprite house"></i>
						</div>
						<div class="article-content-wrapper">
							<div class="article-content-container">
								<?=strip_tags(substr($article['body'], 0, 2000), '<p><h1><h2><h3><h4><h5><h6><a><ol><ul><li><br>');?>[ . . . ]
							</div>
							<div class="article-content-hovered-container">
								<div class="article-quick-actions fr">
									<a href="<?=$uri->create_uri($uri->get_slug(0), 'like', $article['slug']);?>">
										<i class="dsprite32 like"></i>
										<span class="sprite-hover">0</span>
									</a>
									<a href="<?=$uri->create_uri($uri->get_slug(0), $article['slug']);?>#comments">
										<i class="dsprite32 comment"></i>
										<span class="sprite-hover"><?=$model->article_comment_count((int)$article['id']);?></span>
									</a>
								</div>
								<div class="article-view-button-container">
									<div class="article-view-button clr" data-url="<?=$uri->create_uri($uri->get_slug(0), $article['slug']);?>">
										<i class="dsprite view"></i>
										<span>Continue Reading</span>
									</div>
								</div>
								<div class="article-author-container">
									<div class="article-author-image-border">
										<img src="<?=$auth->user_avatar($author['username'])?>" alt="" />
									</div>
									<a href="<?=$uri->create_uri('user', $author['id'] . '-' . $author['username']);?>"><?=$author['first'] . ' ' . $author['last'];?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					endwhile;
				else : ?>
				<div class="article-wrapper">
					<div class="article-container">
					
						<div class="article-header-container clr">
							<i class="article-header-icon dsprite pencil"></i>
							<h2 class="article-header-title">
								<span class="article-link">Oh no, this blog is empty...</span>
							</h2>
						</div>
						<div class="article-content-wrapper">
							<div class="article-content-container">
								<h4 style="font-size:14px; color:rgb(148, 148, 148);">This could be an error, but we cannot find anything here.</h4>
							</div>
						</div>
						
					</div>
				</div>
				<?php endif;?>
			</div>
		</div>
<?php require_once $public->render('footer'); ?>