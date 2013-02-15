<h1 class="welcome-x"><?=__('common.hey-there-x', User::info('first'));?>!</h1>
<?php if (Auth::can('admin') || Auth::can('moderator')) : ?>
<div class="feed-wrapper">
    <h2><?=__('common.tools');?></h2>
    <ul class="recent-things">
        <li>
            <?php if (Auth::can('draffft_post_article')) : ?>
            <a href="<?=Application::link('new');?>" class="btn"><i class="icon-pencil"></i> <?=__('common.write');?></a>
            <?php endif; ?>
            <?php if (Auth::can('draffft_edit_article')) : ?>
            <a href="" class="btn"><i class="icon-cogs"></i> <?=__('common.manage')?></a>
            <?php endif; ?>
            <a href="" class="btn"><i class="icon-bar-chart"></i> <?=__('common.stats');?></a>
            <a href="" class="btn"><i class="icon-calendar"></i> <?=__('common.campaign');?></a>
            <a href="" class="btn"><i class="icon-picture"></i> <?=__('common.media');?></a>
            <a href="<?=Application::link('logout');?>" class="btn"><i class="icon-off"></i> <?=__('common.logout');?></a>
        </li>
    </ul>
</div>

<?php elseif (Auth::can('user')) : ?>
<div class="feed-wrapper">
    <h2><?=__('common.actions');?></h2>
    <ul class="recent-things">
        <li>
            <a href="<?=Application::link('logout');?>" class="btn"><i class="icon-off"></i> Logout</a>
        </li>
    </ul>
</div>
<?php endif;?>

<div class="feed-wrapper">
    <h2><?=__('common.recent');?></h2>
    <ul class="recent-things">
    <?php foreach (Article::all(5) as $article) : ?>
        <li>
            <div class="posted-date" title="<?=Time::stamp($article['date'], 'short');?>"><?=Time::since($article['date']);?></div>
            <h4>
                <a href="<?=Article::link($article['id'], $article['title']);?>"><?=$article['title'];?></a>
            </h4>
            <div class="post-meta">
                <a class="" href="<?=Article::link($article['id'], $article['title']);?>#comments">
                    <i class="icon-comments"></i> <?=Comments::count($article['id']);?> comments
                    <i class="icon-heart"></i> <?=Likes::count($article['id']);?> likes
                </a>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
