<?=($meta);?>
<div class="body-wrapper clr">
    <section class="grid-75">
        <div class="cruby-wrapper">
            <?=$breadcrumbs;?>
        </div>
        <article class="article-overview-wrapper clr">
            
            <header class="article-title clr">
                <h2><?=Article::title();?></h2>
                <div class="article-meta-block">
                    <h3><?=date('j', Article::date());?></h3>
                    <span><time datetime="<?=date('c', Article::date());?>" pubdate><?=date('F Y', Article::date());?></time></span>
                </div>
            </header>
            
            <?php if (Article::image() !== '') : ?>
            <div class="image-wrapper">
                <div class="image-container">
                    <img src="<?=Application::asset_url(Article::image());?>" alt="" />
                </div>
            </div>
            <?php endif; ?>
            
            <div class="article-copy-preview clr">
                <p><em><?=Article::description();?></em></p>
                <?=preg_replace('#\|\|\|\|PREVIEW\|\|\|\|#i', '', Article::body());?>
            </div>
            
            <footer class="clr" id="comments">
                <ul>
                    <li><?=Article::comments_count();?></li>
                    <li><?=Article::likes_count();?></li>
                </ul>
            </footer>
        </article>
        <div class="article-comments-wrapper">
            <?=$comments;?>
            <?php //View::make('article/pingback', ['article' => $article]);?>
        </div>
    </section>
    
    <section class="grid-25">
    <?php if (Auth::can('user')) : ?>
        <?=View::make('sidebar/feed');?>
    <?php else : ?>
        <?=View::make('sidebar/login');?>
    <?php endif; ?>
    </section>
</div>
<?php if (Article::allow_comments() && Auth::can('draffft_post_comment')) : ?>
    <script src="<?=Uri::make('core', 'Vendor', 'souleedit', 'sf-edit.js');?>"></script>
    <script>
    $(d).ready(function() {
        $('textarea').sfedit({
            template: '<h3>You are using the <a target="_blank" title="[I open in a new tab!] Learn it real quick" href="http://daringfireball.net/projects/markdown/syntax">Markdown</a> editor</h3>',
            ajaxUrl: "<?=Application::link('comment', 'ajax');?>"
        }).scmf_scroll({
            height: 		'150px',
		    wrapperClass: 	'sf-uix-scroll-wrapper',
		    rbwrapClass: 	'sf-uix-scroll-rb-wrapper nib-only',
		    railClass: 		'sf-uix-scroll-rail nib-only',
		    barClass: 		'sf-uix-scroll-bar nib-only'
        });
    });
    </script>
<?php endif; ?>
<?=View::make('footer');?>
