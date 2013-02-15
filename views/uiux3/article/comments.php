<?php if (Comments::open()) : ?>
<div class="article-comments-wrapper">
	<?php if (Comments::count() !== 0) : ?>
	<h2 class="article-comments-annoted" id="comments">Comments</h2>
	<?=Comments::show();?>
	
	<div>
    	<a href="<?=Uri::make('', true)?>" class="sf-uix-button color-blue">Home</a>
    	<a href="#top" class="sf-uix-button color-blue">Top</a>
    </div>
	
	<?php else : ?>
	<h2 class="article-comments-annoted" id="comments">No Comments</h2>
	<?php endif; ?>
</div>
<?php endif; ?>