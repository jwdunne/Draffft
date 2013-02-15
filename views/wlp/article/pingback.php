<?php if (Pingback::get($article['id'])) : ?>
<div class="feed-wrapper">
    <h2>Pingbacks</h2>
    <ul class="recent-things">
    <?php foreach (Pingback::get($article['id']) as $ping) : ?>
        <li>
            <h4>
                <a href="<?=$ping['uri']?>"><?=$ping['author'];?></a> <span><?=Time::since($ping['date']);?></span>
            </h4>
            <div class="post-meta">
                <p><?=$ping['excerpt'];?></p>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
