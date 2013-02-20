<?=$meta;?>
<div class="body-wrapper clr">
    <section class="grid-full">
    <?php foreach ([1, 2, 6] as $group) : ?>
        <?php foreach (Group::users($group) as $user) : ?>
        <article class="article-overview-wrapper clr">
            <header class="article-title clr">
                <h2><?=("{$user['first']} {$user['last']} ({$user['username']})");?></h2>
            </header>
            
            <div class="image-wrapper">
                <div class="image-container">
                    <img class="about-us-img" src="<?=User::avatar($user['username']);?>" alt="<?=$user['username'];?>&#39;s avatar" />
                </div>
            </div>
            
            <div class="article-copy-preview clr">
                <?=$user['draffft_about'];?>
            </div>
        </article>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </section>
</div>
<?=$footer;?>
