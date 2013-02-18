<h1 class="welcome-x"><?=__('common.hey-there-x', User::info('first'));?>!</h1>
<div class="feed-wrapper">
    <h2><?=__('common.actions');?></h2>
    <ul class="recent-things">
        <li>
            <?php if (Auth::can('draffft_post_article')) : ?>
            <a href="<?=Application::link('new');?>" class="btn"><i class="icon-pencil"></i> <?=__('common.write');?></a>
            <?php endif; ?>
            <?php if (Auth::can('draffft_edit_article') && (stripos(Uri::current(), 'view') !== false)) : ?>
            <a href="<?=Application::link('edit', Article::id() . '-' . Strings::slug(Article::title()));?>" class="btn"><i class="icon-cogs"></i> <?=__('common.manage')?></a>
            <?php endif; ?>
            <?php if (Auth::can('admin')) : ?>
            <a href="<?=Uri::make('dashboard', 'stats');?>" class="btn"><i class="icon-bar-chart"></i> <?=__('common.stats');?></a>
            <a href="<?=Uri::make('dashboad', 'campaign', 'new');?>" class="btn"><i class="icon-calendar"></i> <?=__('common.campaign');?></a>
            <?php endif; ?>
            <?php if (Auth::can('draffft_post_article')) : ?>
            <a href="<?=Uri::make('dashboard', 'media');?>" class="btn"><i class="icon-picture"></i> <?=__('common.media');?></a>
            <?php endif; ?>
            <a href="<?=Application::link('logout');?>" class="btn"><i class="icon-off"></i> <?=__('common.logout');?></a>
        </li>
    </ul>
</div>

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
