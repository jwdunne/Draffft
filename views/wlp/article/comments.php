<?php if (Comments::open() && Auth::can('draffft_post_comment')) : ?>
    <form action="<?=Application::link('post');?>" method="post">
        <input type="hidden" value="<?=Article::id();?>" name="article_id" />
        <input type="hidden" name="in_reply" value="0" />
        <textarea name="comment"></textarea>
    </form>
<?php else : ?>
    <h3 class="comments-status"><?=Auth::can('user') ? 'Comments are closed' : 'You must be logged in to comment';?></h3>
<?php endif; ?>
<?php foreach (Comments::get_all() as $comment) : ?>
    <?=Comments::show($comment['id']);?>
<?php endforeach; ?>
<script>
$(d).ready(function() {

    $('.article-comments-container').dblclick(function() {
        var t        = $(this),
            color    = '2px solid rgb(125, 125, 125)',
            hold     = $('input[name="in_reply"]'),
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

    $('.in-reply').each(function(i, el) {
        $(el).css({
            'margin-left': 15 * (i + 1)
        });
    });
});
</script>
