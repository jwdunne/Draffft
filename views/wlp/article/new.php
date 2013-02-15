<?=($meta);?>
<div class="body-wrapper clr">
	<section class="grid-full">
	    <article class="article-overview-wrapper clr">
            
            <header class="article-title clr">
                <h2>Authoring A New Post</h2>
            </header>
            
            <section>
                <form class="blocky-form" action="<?=Application::link('new');?>" method="post">
                    <input type="text" name="title" placeholder="Title. . ." />
                    <input type="text" name="description" placeholder="Description. . ." />
                    
                    <div class="label-box">
                        <label for="show_about">Show Your About?</label>
                        <input type="checkbox" value="1" name="show_about" id="show_about"/>
                    </div>
                    <div class="label-box">
                        <label for="allow_comments">Allow Commenting?</label>
                        <input type="checkbox" value="1" name="allow_comments" id="allow_comments"/>
                    </div>
                    <select name="category_id">
                    <?php foreach(Category::all() as $category) : ?>
                        <option value="<?=$category['id'];?>"><?=$category['title'];?></option>
                    <?php endforeach; ?>
                        <option value="0">New Category</option>
                    </select>
                    <textarea name="body"></textarea>
                    <div>
                        <label for="pc_image"></label>
                        <input type="file" name="image" id="pc_image" />
                    </div>
                    <input type="submit" value="Post" />
                </form>
            </section>
            
        </article>
	</section>
</div>
<script src="<?=Uri::make('core', 'Vendor', 'souleedit', 'sf-edit.js');?>"></script>
<script>
$(d).ready(function() {
    var new_cat = false;
    $('select').on('click', function() {
        var t = $(this);
            
        if (t.val() == '0' && !new_cat) {
            new_cat = true;
            t.attr('name', '');
            $('<input type="text" name="category_id" placeholder="Category Name . . .">').insertAfter('select');
        } else if (new_cat) {
            new_cat = false;
            $('input[name="category_id"]').remove();
            t.attr('name', 'category_id');
        }
    });

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
