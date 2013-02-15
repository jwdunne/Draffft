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

class Likes extends Model
{
    public static $table = DT_LIKES_TABLE;
    
    private static $data = [
        'id'         => 0,
        'article_id' => 0,
        'user_id'    => 0
    ];
    
    public static function count($article_id = null)
    {
        $article_id = ($article_id === null) ? Article::id() : $article_id;
        return (int)Query::table(static::$table)->where('article_id', $article_id)->count();
    }
    
    public static function cat()
    {
        
    }
    
    public static function rm()
    {
        
    }
}
