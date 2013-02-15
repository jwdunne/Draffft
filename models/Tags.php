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

use Soule\Application\Model,
    Soule\Database\Modules\Query;

class Tags extends Model
{
    public static $table = DT_TAGS_TABLE;
    
    protected static $data = [];
    
    public static function get($id)
    {
        static::$data = static::where('id', $id)->limit(1)->fetch();
    }
    
    public static function id()
    {
        return static::$data['id'];
    }
    
    public static function name()
    {
        return static::$data['name'];
    }
    
    public static function articles()
    {
        foreach (static::decode_articles() as $article_id)
        {
            foreach (Query::table(DT_ARTICLES_TABLE)->where('id', $article_id)->get() as $article) {
                $tagged[] = $article;
            }
        }
        
        return $tagged;
    }
    
    private static function decode_articles()
    {
        return $articles = json_decode(static::$data['articles']);
    }
}
