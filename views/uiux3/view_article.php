<?php require_once $public->render('meta'); ?>
		<?=$application->stylesheet();?>
		<?php
		if($article['allow_comments'] && $auth->is_authd() && $auth->can('draffft_post_comment')) :
			echo $public->jscript($uri->create_uri('plugins', 'texteditors', 'souleedit', 'sf-edit.js'));
		endif;
		?>
		<script>
		$(d).ready(function() {
			$('.sf-uix-button.show').click(function() {
				var $this = $(this),
				cid = $this.attr('data-id');

				$('.article-comment-wrapper#' + cid).fadeIn('slow');
				$this.parents('.spam-warning').fadeOut('fast').remove();
				
			});
			$('.sf-uix-button.flag').click(function() {
				var $this = $(this),
				cid = $this.attr('data-id');
				/**
				 * @todo xhr request to set status to 0
				 */
				$('.article-comment-wrapper#' + cid).fadeOut('slow');
			});
			<?php if($article['allow_comments'] && $auth->is_authd() && $auth->can('draffft_post_comment')) : ?>
			$('textarea').sfedit({
				ajaxURL: 		'campr/ajax/thread_post_preview',
				bgColorOrClass: 'sf-edit-uiux3-style',
				hasForm:		true,
				submitName:		'submit_reply',
				formAction:		this_script,
				submitName:		'submit_reply',
				hideOrShow:		'hide',
			}).scmf_scroll({height: '150px'});
			<?php endif; ?>
		});
		</script>
	</head>
	<body>
		<?php require_once $public->render('header');?>
		<div class="page-wrapper article">
			<div class="draffft-title-wrapper">
				<div class="draffft-title-container clr">
					<h1><?=$article['title'];?></h1>
					<p><?=$article['description'];?></p>
					<h6>
						<span>Posted on <?=long_timestamp($article['date']);?> in <?=$article['cat_title'];?></span>
					</h6>
				</div>
			</div>
			
			<?php if($auth->can('draffft_edit_article')) : ?>
			<div class="draffft-new-article-container clr">
				<span>Author Controls</span>
				<div class="draffft-new-button-container">
					<a href="<?=$uri->create_uri('admincp', 'draffft', 'edit');?>" class="sf-uix-button color-blue">Edit Article</a>
					<button class="sf-uix-button smaller close-admin-bar">&times;</button>
				</div>
			</div>
			<?php endif;?>
			
			<div class="page-container">
				<div class="pgraph-wrapper">
					<?=$article['body'];?>
				</div>
			</div>
			<div class="about-author-wrapper clr">
				<?php if($article['show_about']) : ?>
				<div class="about-author-meta">
					<div class="article-author-image-border">
						<img src="<?=$auth->user_avatar($author['username'])?>" alt="" />
					</div>
					<div style="margin-left:80px;">
						<p class="about-author-pgraph"><a href="#"><?=$author['first'] . ' ' . $author['last'];?></a> <?=$author['draffft_about'];?></p>
					</div>
				</div>
				<?php endif; ?>	
			</div>
			<div>
				<a href="<?=$uri->create_uri('draffft')?>" class="sf-uix-button color-blue">Home</a>
				<a href="#top" class="sf-uix-button color-blue">Top</a>
			</div>
			<?php if($article['allow_comments']) :
				require_once $application->render('comments');
				
				if($auth->is_authd() && $auth->can('draffft_post_comment')) : ?>
				<textarea></textarea>
				<?php endif; ?>
			
			<?php else : ?>
				<h2 class="article-comments-closed">Comments are closed for this article.</h2>
			<?php endif; ?>
		</div>
<?php require_once $public->render('footer'); ?>