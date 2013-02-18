<?=($meta);?>
<div class="body-wrapper clr">
    <section class="grid-75">
        <div class="cruby-wrapper">
            <?=Breadcrumbs::make([Article::title() => Uri::current()]);?>
        </div>
        <article class="article-overview-wrapper clr">
            <header class="article-title clr">
                <h2><?=Article::title();?></h2>
                <div class="article-meta-block">
                    <h3><?=date('j', Article::date());?></h3>
                    <span><time datetime="<?=date('c', Article::date());?>" pubdate><?=date('F Y', Article::date());?></time></span>
                </div>
            </header>
            
            <div class="article-copy-preview clr">
                <p><em><?=Article::description();?></em></p>
                
                <?php if (Article::image() !== '') : ?>
                <div class="image-wrapper">
                    <div class="image-container">
                        <img src="<?=Article::image();?>" alt="" />
                    </div>
                </div>
                <?php endif; ?>
                
                <?=Article::body();?>
            </div>
            
            <footer class="clr" id="comments">
                <ul>
                    <li><?=Article::comments_count();?></li>
                    <li><?=Article::likes_count();?></li>
                </ul>
            </footer>
        </article>
        <div class="article-comments-wrapper">
            <?=View::make('article/comments');?>
            <?php //View::make('article/pingback');?>
        </div>
    </section>
    
    <section class="grid-25">
        <?=View::make('sidebar/sidebar');?>
    </section>
</div>
<?=View::make('footer');?>
