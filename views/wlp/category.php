<?=$meta;?>
<div class="body-wrapper clr">
    <section class="grid-75">
        <article class="results">
        <?php if (!Category::articles(Category::id())) : ?>
            <h2>The Category <?=Category::title();?> Returned No Results</h2>
        <?php else : ?>
            <h2>All <?=Category::title();?></h2>
        <?php endif; ?>
            <ul>
            <?php foreach (Category::articles(Category::id()) as $article) : ?>
            <?php Article::get($article['id']); ?>
                <li><i class="icon-circle-arrow-right"></i> <a href="<?=Article::link();?>"><?=Article::title();?></a></li>
            <?php endforeach; ?>
            </ul>
        </article>
    </section>
    
    <section class="grid-25">
    <?php if (Auth::is()) : ?>
        <?=View::make('sidebar/feed');?>
    <?php else : ?>
        <?=View::make('sidebar/login');?>
    <?php endif; ?>
    </section>
</div>
<?=View::make('footer');?>
