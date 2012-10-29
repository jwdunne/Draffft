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
		<div class="draffft-title-wrapper">
			<div class="draffft-title-container">
				<h6>
					<span><i class="sprite-ui sprite-ui-date-time"></i>Posted on <?=long_timestamp($article['date']);?></span>
					<span><i class="sprite-ui sprite-ui-folder"></i>Filed in <?=$article['cat_title'];?></span>
				</h6>
				<h1><?=$article['title'];?></h1>
				<p><?=$article['description'];?></p>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
				<?=$article['body'];?>
			</div>
			<div class="about-author-wrapper clr">
				<h2>Tags</h2>
				<i class="sprite-ui sprite-ui-tag"></i>
				<a href="" class="article-tag">dummy tag</a>
				<a href="" class="article-tag">dummy tag</a>
				<h2 id="author" class="about-author-annoted">About the Author</h2>
				<?php if($article['show_about']) : ?>
				<div class="about-author-meta">
					<div class="about-author-avatar-container">
						<img class="about-author-avatar" alt="" src="<?=$auth->user_avatar($author['username'])?>">
					</div>
					<div style="margin-left:80px;">
					<?php if(!empty($author['website'])): ?>
					<h4><a href="<?=$author['website'];?>"><?=$author['first'] . ' ' . $author['last'];?>&#39;s</a> personal website,</h4>
					<?php
					endif;
					if(!empty($author['twitter'])) :
					?>
					<h4><a href="//twitter.com/!#/<?=$author['twitter'];?>">@<?=$author['twitter'];?></a> on twitter</h4>
					<?php endif;?>
					</div>
					<p class="about-author-pgraph"><a href="#"><?=$author['first'] . ' ' . $author['last'];?></a> <?=$author['draffft_about'];?></p>
				</div>
				<?php endif; ?>	
			</div>
			<div>
				<a href="<?=$uri->create_uri('draffft')?>" class="sf-uix-button color-blue">Home</a>
				<a href="#top" class="sf-uix-button color-blue">Top</a>
			</div>
			<?php
			require_once $application->render('comments');
			
			if($article['allow_comments']) :
				if($auth->is_authd() && $auth->can('draffft_post_comment')) : ?>
				<textarea></textarea>
				<?php endif; ?>
			
			<?php else : ?>
				<h2 class="article-comments-closed">Comments are closed for this article.</h2>
			<?php endif; ?>
		</div>
<?php require_once $public->render('footer');
