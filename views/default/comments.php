<div class="article-comments-wrapper">
	<?php if($comment_count !== 0) : ?>
	<h2 class="article-comments-annoted" id="comments">#Comments</h2>
	<?php
		$model->show_comments($comments);
	else :
	?>
	<h2 class="article-comments-annoted" id="comments">No Comments</h2>
	<?php endif; ?>
</div>
<?php if($comment_count !== 0) : ?>
<div>
	<a href="<?=$uri->create_uri('draffft')?>" class="sf-uix-button color-blue">Home</a>
	<a href="#top" class="sf-uix-button color-blue">Top</a>
</div>
<?php endif; ?>