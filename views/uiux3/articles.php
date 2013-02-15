<?=$meta;?>
		<script type="text/javascript">
		$(d).ready(function() {

			var $article = $('.article-wrapper');
			
			function pos_btns() {
				$('.article-view-button-container').each(function() {
	
					$(this).css({
						position:	'relative',
						top:		dead_center('.article-content-hovered-container', $(this))
					});
					
				});
			}
			
			$article.hover(function() {
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

		    $('.do-grid-view').click(function() {
			    
			    $article.animate({
				    'width': '48%'
				});
				$('.article-wrapper:even').css({
					'margin': '0 2% 0 0',
					'float': 'left',
					'min-height': '225px'
				});
				$('.article-wrapper:odd').css({
					'margin': '0 0 0 2%',
				    'float': 'right',
					'min-height': '225px'
				});
			});

			$('.do-list-view').click(function() {
			    $article.animate({
				    'width': '100%'
				}).css({
					'margin': '0px 0px 15px',
					'float': 'none',
					'min-height': 'initial'
				});
			});
			
		});
		</script>
		<style>
		.do-grid-view, .do-list-view {
            cursor:        pointer;
            margin:        0px 4px;
            color:         rgb(95, 95, 95);
            font-size:     1.1em;
		}
		</style>
	</head>
	<body>
		<div class="page-wrapper articles">
			<div class="draffft-title-wrapper">
				<div class="draffft-title-container clr">
					<h1><?=Application::info('public_name')?></h1>
					<p><?=Application::info('tagline');?></p>
				</div>
			</div>
			
			<div class="crumby-wrapper">
    			<?=$breadcrumbs;?>
    		</div>
    		<div style="display:inline-block;">
    		    <i class="icon-th-large do-grid-view" title="grid view"></i>
    		    <i class="icon-reorder do-list-view" title="list view"></i>
    		</div>
    		<div class="paginations fr">
				<?=Paginations::display();?>
			</div>
			
			<?php if (Auth::can('draffft_post_article')) : ?>
			<div class="draffft-new-article-container clr">
				<span>Author Controls</span>
				<div class="draffft-new-button-container">
					<a href="<?=Uri::make('new', true);?>" class="sf-uix-button color-android">New Article</a>
					<a href="<?=Uri::make('edit', true);?>" class="sf-uix-button color-blue">Edit Articles</a>
					<button class="sf-uix-button smaller close-admin-bar icon-remove-sign"></button>
				</div>
			</div>
			<?php endif; ?>
		    
		    <div class="page-container">
			    <?php if(Articles::total() >= 1) : ?>
				    <?php foreach (Articles::get() as $article) : ?>
				        <?php $author = User::find($article['user_id']);?>
				<div class="article-wrapper">
					<div class="article-container">
						<div class="article-header-container clr">
							<i class="article-header-icon icon-book"></i>
							<h2 class="article-header-title">
								<a class="article-link" href="<?=Article::link($article['id'], $article['slug']);?>" data-desc="<?=$article['description']?>"><?=$article['title'];?></a>
							</h2>
							<h4 class="article-header-date"><?=Time::since($article['date']);?></h4>
							<i class="article-header-time-icon icon-time"></i>
						</div>
						<div class="article-content-wrapper">
							<div class="article-content-container">
								<?=Article::preview($article['body'], 500);?>
							</div>
							<div class="article-content-hovered-container">
								<div class="article-quick-actions fr">
									<a href="<?=Uri::make("like/{$article['id']}-{$article['slug']}", true);?>">
										<i class="icon-heart" ></i>
										<?php // XXX ?>
										<span class="sprite-hover"><?=Likes::count($article['id']);?></span>
									</a>
									<a href="<?=Article::link($article['id'], $article['slug']);?>#comments">
										<i class="icon-comments"></i>
										<span class="sprite-hover"><?=Comments::count($article['id']);?></span>
									</a>
								</div>
								<div class="article-view-button-container">
									<div class="article-view-button clr" data-url="<?=Article::link($article['id'], $article['slug']);?>">
										<i class="icon-eye-open"></i>
										<span>Continue Reading</span>
									</div>
								</div>
								<div class="article-author-container">
									<div class="article-author-image-border">
										<img src="<?=User::avatar($author['username'])?>" alt="" />
									</div>
									<a href="<?=Uri::make("user/{$author['id']}-{$author['username']}");?>"><?=$author['first'] . ' ' . $author['last'];?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					endforeach;
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
				
				<div class="paginations centered">
    				<?=Paginations::display();?>
    			</div>
    			
			</div>
			
		</div>