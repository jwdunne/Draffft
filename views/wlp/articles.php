<?=$meta;?>
<div class="body-wrapper clr">
    <section class="grid-75">
    <?php if (Article::total() >= 1) : ?>
        <?php foreach (Article::all() as $article) : ?>
        <?php Article::get($article['id']); // not required, but to make things easier! ?>
        <article class="article-overview-wrapper clr">
            <header class="article-title clr">
                <h2><a href="<?=Article::link();?>"><?=Article::title();?></a></h2>
                <div class="article-meta-block">
                    <h3><?=date('j', Article::date());?></h3>
                    <span><time datetime="<?=date('c', Article::date());?>" pubdate><?=date('F Y', Article::date());?></time></span>
                </div>
            </header>
            
            <?php if (Article::image() != '') : ?>
            <div class="image-wrapper">
                <div class="image-container">
                    <img src="<?=Article::image();?>" alt="" />
                </div>
            </div>
            <?php endif; ?>
            
            <div class="article-copy-preview clr">
                <?=Article::preview(500, "<br /><a href='" . Article::link() . "'>" . __('common.continue') . "</a>");?>
            </div>
            
            <footer class="clr">
                <ul>
                    <li><?=Article::comments_count();?></li>
                    <li><?=Article::likes_count();?></li>
                </ul>
            </footer>
            
        </article>
        <?php endforeach; ?>
    <?php else : ?>
        <article class="article-overview-wrapper clr">
            <header class="article-title clr">
                <h2><?=__('common.empty-blog-title');?></h2>
            </header>
            <div class="article-copy-preview clr">
                <?=__('common.empty-blog-desc');?>
            </div>
        </article>
    <?php endif; ?>
    <div class="paginations">
        <?=Paginations::display();?>
    </div>
    </section>
    
    <section class="grid-25">
        <?=View::make('sidebar/sidebar');?>
    </section>
</div>
<?=View::make('footer');?>
