<?php if (Comments::open() && Auth::can('draffft_post_comment')) : ?>
    <script src="<?=Uri::make('core', 'Vendor', 'souleedit', 'sf-edit.js');?>"></script>
    <form id="comment-form" action="<?=Application::link('comment');?>" method="post">
        <input type="hidden" value="<?=Article::id();?>" name="article_id" />
        <input type="hidden" name="reply_to" value="0" />
        <textarea name="comment" id="comment-txtarea"></textarea>
        <input type="submit" value="Comment" />
    </form>
    <?php if (Comments::count() > 0) : ?>
    <h4 class="comments-note">Double click a comment below to reply to it! (double click again to not)</h4>
    <?php endif; ?>
<?php elseif (!Comments::open()) : ?>
    <h3 class="comments-status"><?=__('common.comments-closed');?></h3>
<?php else : ?>
    <h3 class="comments-status"><?=__('common.comments-guest');?></h3>
<?php endif; ?>
<?php foreach (Comments::get_all() as $comment) : ?>
    <?=Comments::show($comment['id']);?>
<?php endforeach; ?>
<script>
$(d).ready(function() {
    <?php if (Comments::open() && Auth::can('user')) : ?>
    $('.article-comments-container').dblclick(function() {
        var t        = $(this),
            color    = '2px solid rgb(125, 125, 125)',
            hold     = $('input[name="reply_to"]'),
            reply_to = t.attr('id'),
            buffer   = hold.val();
            
            $('.article-comments-container').css('border-left', color);
            
            if (buffer == reply_to) {
                hold.val(0);
                t.css('border-left', color)
            } else {
                hold.val(reply_to);
                t.css('border-left', '5px solid rgb(220, 25, 25)');
            }
    });
    
    $('textarea').sfedit({
        hideOrShow: 'show',
        template:   '<h3>You are using the <a target="_blank" title="[I open in a new tab!] Learn it real quick" href="http://daringfireball.net/projects/markdown/syntax">Markdown</a> editor</h3>',
        ajaxUrl:    "<?=Application::link('comment', 'ajax');?>"
    }).scmf_scroll({
        height: 		'150px',
	    wrapperClass: 	'sf-uix-scroll-wrapper',
	    rbwrapClass: 	'sf-uix-scroll-rb-wrapper nib-only',
	    railClass: 		'sf-uix-scroll-rail nib-only',
	    barClass: 		'sf-uix-scroll-bar nib-only'
    });
    
    <?php endif; ?>

    $('.delete-comment').on('click', function() {
        var t       = $(this),
            comment = t.parents('.article-comments-container'),
            author  = comment.find('.comment-author-name span').text(),
            curl    = app_url + 'comment/delete/' + comment.attr('id');
            
        if (confirm("Delete comment by " + author + "?"))
        {
            $.ajax({
                type: 'POST',
                url: curl,
                success: function() {
                    comment.remove();
                }
            });
        }
    });

    $('.in-reply').each(function(i, el) {
        $(el).css({
            'margin-left': 15 * (i + 1)
        });
    });
});
</script>
