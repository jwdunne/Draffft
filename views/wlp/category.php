<?=$meta;?>
<div class="body-wrapper clr">
    <section class="grid-75">
        <div class="cruby-wrapper">
            <?=Breadcrumbs::make([Category::title() => Uri::current()]);?>
        </div>
        <article class="results">
        <?php if (!Category::articles(Category::id())) : ?>
            <h2><?=__('common.category-x-empty', Category::title());?></h2>
        <?php else : ?>
            <h2><?=__('common.category-all-x', Category::title());?></h2>
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
        <?=View::make('sidebar/sidebar');?>
    </section>
</div>
<?=View::make('footer');?>
