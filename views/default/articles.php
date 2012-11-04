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
		<style>
		.view-this-article {
			display:					none;
			cursor:						pointer;
		}
		.view-this-article h2 {
			color:						rgb(248, 248, 248);
			text-align: 				center;
			font-size: 					32px;
			letter-spacing:				2px;
			text-shadow: 				0px -1px 0px rgba(0, 0, 0, 0.6);
			display: 					inline-block;
			margin: 					0px auto;
			width: 						100%;
		}
		.article-preview:hover {
			border-color:			rgba(0, 0, 0, 0.6);
		}
		.article-preview:hover .view-this-article {
			z-index:				1;
			display:				block;
			width: 					100%;
			position: 				absolute;
			top: 					0;
			left: 					0;
			right: 					0;
			bottom: 				0;
			background: 			rgba(0, 0, 0, 0.35);
		}
		.article-preview .view-this-article h2:hover {
			color:					rgb(255, 255, 255);
		}
		.draffft-new-button-container {
			margin-top:		10px;
		}
		</style>
	</head>
	<body>
	
		<div class="draffft-title-wrapper">
			<div class="draffft-title-container clr">
				<?php if (Auth::can('draffft_post_article') || Auth::can('admin')) : ?>
					<div class="fr draffft-new-button-container">
						<a href="<?=URI::make('new');?>" class="sf-uix-button color-blue">New Article</a>
					</div>
				<?php endif;?>
				<h1><?=Settings::read('draffft_name');?></h1>
				<p><?=Settings::read('draffft_slogan');?></p>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
				<?php
				//if ($model->total_articles() !== 0) :
					//while($article = $db->fassoc($articles)) :
				?>
					<div class="article-wrapper">
						<div class="article-container">
							<div class="article-meta clr">
								<h6>
									<span><i class="icon-time"></i>Posted <?php //TimeDate::time_since($article['date']);?></span>
									<span><i class="icon-user"></i>By <?php //Auth::get_user((int)$article['user_id'], 'username'); ?></span>
									<span>
										<i class="icon-comment"></i>
										<a href="<?php //URI::make($article['slug']);?>#comments">0<?php //$model->article_comment_count((int)$article['id']);?> Comments</a>
									</span>
								</h6>
								<div class="article-title-n-description">
									<h2><a class="article-link" href="<?php //URI::make($article['slug']);?>"><?php //$article['title'];?></a></h2>
									<h3><?php //$article['description'];?></h3>
								</div>
							</div>
							<div class="article-preview">
								<div class="view-this-article"><h2>Read Article</h2></div>
									<div class="pgraph-wrapper">
										<?php //strip_tags(substr($article['body'], 0, 1200), '<p><h1><h2><h3><h4><h5><h6><a><ol><ul><li><br>');?> [ . . . ]
									</div>
							</div>
						</div>
					</div>
				<?php
					//endwhile;
				//else : ?>
				<div class="article-wrapper">
					<div class="article-container">
						<div class="article-meta" style="margin:0px auto; text-align:center;">
							<h2 style="font-size:24px; color:rgb(148, 148, 148);">Oh no, this blog is empty...</h2>
							<h4 style="font-size:14px; color:rgb(148, 148, 148);">This could be an error, but we cannot find anything here.</h4>
						</div>
					</div>
				</div>
				<?php //endif;?>
			</div>
		</div>