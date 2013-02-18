<?=($meta);?>
<div class="body-wrapper clr">
	<section class="grid-full">
	    <article class="article-overview-wrapper clr">
            
            <header class="article-title clr">
                <h2><?=__('common.editing-x', Article::title());?></h2>
            </header>
            
            <section>
                <form class="blocky-form" action="<?=Application::link('edit');?>" method="post">
                    <input type="hidden" name="id" value="<?=Article::id();?>" />
                    <input type="text" name="title" placeholder="Title. . ." value="<?=Article::title();?>" />
                    <input type="text" name="description" placeholder="Description. . ." value="<?=Article::description();?>" />
                    
                    <div class="label-box">
                        <label for="show_about">Show Your About?</label>
                        <input type="checkbox" value="1" name="show_about" id="show_about" <?=(Article::show_about()) ? 'checked="checked"' : '';?>/>
                    </div>
                    <div class="label-box">
                        <label for="allow_comments">Allow Commenting?</label>
                        <input type="checkbox" value="1" name="allow_comments" id="allow_comments" <?=(Article::allow_comments()) ? 'checked="checked"' : '';?>/>
                    </div>
                    <select name="category_id">
                    <?php foreach(Category::all() as $category) : ?>
                        <option value="<?=$category['id'];?>" <?=(Article::category_id() == (int)$category['id']) ? 'selected="selected"' : '';?>><?=$category['title'];?></option>
                    <?php endforeach; ?>
                        <option value="0"><?=__('common.new-category');?></option>
                    </select>
                    <textarea name="body"><?=Article::body();?></textarea>
                    <div class="upload-wrapper">
                        <label for="url_image"><?=__('common.add-image');?></label>
                        <input type="text" name="image" id="url_image" placeholder="http://" value="<?=Article::image();?>" />
                    </div>
                    <input type="submit" value="Confirm" />
                </form>
            </section>
            
        </article>
	</section>
</div>
<script src="<?=Uri::make('core', 'Vendor', 'souleedit', 'sf-edit.js');?>"></script>
<script>
$(d).ready(function() {
    $('textarea').sfedit({
        hideOrShow: 'show',
        template:   '<h3>You are using the <a target="_blank" title="[I open In a new tab!] Learn it real quick" href="http://daringfireball.net/projects/markdown/syntax">Markdown</a> editor</h3>',
        ajaxUrl:    "<?=Application::link('comment', 'ajax');?>"
    }).scmf_scroll({
        height: 		'250px',
        wrapperClass: 	'sf-uix-scroll-wrapper',
        rbwrapClass: 	'sf-uix-scroll-rb-wrapper nib-only',
        railClass: 		'sf-uix-scroll-rail nib-only',
        barClass: 		'sf-uix-scroll-bar nib-only'
    });
});
</script>
<?=View::make('footer');?>
