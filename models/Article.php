<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Draffft
 * @version    1.3
 * @copyright  2011 - 2013 (c) devxdev.com
 * @license    http://soule.io/license
 * @author     Soule
 * @link       http://soule.io/draffft
 * @since      1.0
 */
namespace apps\draffft\models;
    
use Soule\Application\Application,
    Soule\Application\Paginations,
    Soule\Database\Modules\Query,
    Soule\HttpKernel\Uri,
    Soule\IO\Strings,
    Soule\Parser\Parser,
    Soule\User\User;

class Article
{

    public static $table = DT_ARTICLES_TABLE;

    protected static $id = 0;
    
    protected static $article = null;
    
    public static function all($limit = null)
    {
        $limit = ($limit == null) ? Paginations::limit() : $limit;
        return Query::table(static::$table)->order_by('date', 'DESC')->limit($limit)->get();
    }
    
    public static function total()
    {
        return count(static::all());
    }
    
    public static function get($id)
    {
        static::$article = Query::table(static::$table)->where('id', $id)->limit(1)->fetch();
    }
    
    public static function id()
    {
        return static::$article['id'];
    }
    
    public static function date()
    {
        return (int)static::$article['date'];
    }
    
    public static function title()
    {
        return static::$article['title'];
    }
    
    public static function description()
    {
        return static::$article['description'];
    }
    
    public static function body()
    {
        return static::$article['body'];
    }
    
    public static function image()
    {
        return static::$article['image'];
    }
    
    public static function category($cat_id)
    {
        return Category::get($cat_id)['cat_title'];
    }
    
    public static function author()
    {
        return User::find(static::$article['user_id']);
    }
    
    public static function link($uri = null)
    {
        $uri = ($uri == null) ? Article::id() . '-' . Article::title() : implode('-', func_get_args());
        return Application::link('view', Strings::slug($uri));
    }
    
    public static function preview($limit = 1200, $ellipsis = "[ . . . ]")
    {
        $preview = (stripos(static::body(), '||||PREVIEW||||') ? substr(static::body(), 0, stripos(static::body(), '||||PREVIEW||||')) : substr(static::body(), 0, $limit));
        $preview = preg_replace('#\|\|\|\|PREVIEW\|\|\|\|#i', '', $preview);
        return strip_tags($preview, '<p><h1><h2><h3><h4><h5><h6><br><em><strong><b><span><code><pre><ol><ul><li>') . (strlen(static::body()) > $limit ? $ellipsis : '');
    }
    
    public static function likes_count()
    {
        $count = Likes::count(static::id());
        return __($count == 1 ? 'common.x-like' : 'common.x-likes', $count);
    }
    
    public static function comments_count()
    {
        $count = Comments::count(static::id());
        return __($count == 1 ? 'common.x-comment' : 'common.x-comments', $count);
    }
    
    public static function allow_comments()
    {
        if ((int)static::$article['allow_comments']) {
            return true;
        }
        return false;
    }
    
    public static function insert($post)
    {
        if (!preg_match("#[0-9]#", $_POST['category_id'])) {
            $_POST['category_id'] = Category::create(['id' => null, 'title' => $_POST['category_id']]);
        }
        
        return Query::table(static::$table)->insert_get_id([
            'id'             => null,
            'user_id'        => User::info('id'),
            'date'           => time(),
            'title'          => $post['title'],
            'description'    => $post['description'],
            'body'           => Parser::parse_style($post['body'], true),
            'slug'           => '',
            'show_about'     => isset($post['show_about']) ? 1 : 0,
            'allow_comments' => isset($post['allow_comments']) ? 1 : 0,
            'category_id'    => $post['category_id'],
            'image'          => isset($post['image']) ? $post['image'] : '',
        ]);
    }
    
    public static function delete($id)
    {
        Query::table(static::$table)->where('id', $id)->delete();
    }
    
    public static function update($post)
    {
        Query::table(static::$table)->where('id', $post['id'])->update([
            'title'          => $post['title'],
            'description'    => $post['description'],
            'body'           => $post['body'],
            'show_about'     => $post['show_about'],
            'allow_comments' => $post['allow_comments'],
            'category_id'    => $post['category_id'],
            'image'          => $post['image'],
        ]);
    }
}
