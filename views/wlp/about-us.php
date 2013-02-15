<?=$meta;?>
<div class="body-wrapper clr">
    <section class="grid-full">
        <?php foreach (Group::users(1) as $user) : ?>
        <article class="article-overview-wrapper clr">
            <header class="article-title clr">
                <h2><?=("{$user['first']} {$user['last']} ({$user['username']})");?></h2>
            </header>
            
            <div class="image-wrapper">
                <div class="image-container">
                    <img src="<?=User::avatar($user['username']);?>" alt="" />
                </div>
            </div>
            
            <div class="article-copy-preview clr">
                <?=$user['draffft_about'];?>
            </div>
        </article>
        <?php endforeach; ?>
    </section>
</div>
<?=$footer;?>
