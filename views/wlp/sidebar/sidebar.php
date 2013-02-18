<?php if (Auth::can('user')) : ?>
    <?=View::make('sidebar/feed');?>
<?php else : ?>
    <?=View::make('sidebar/login');?>
<?php endif; ?>
