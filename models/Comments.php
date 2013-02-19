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
    Soule\Database\Modules\Query,
    Soule\User\Auth,
    Soule\User\User,
    Soule\Localization\Time;

class Comments extends Model
{
    
    public static $table = DT_COMMENTS_TABLE;
    
    private static $threaded_count = 0;
    
    /**
     * @ignore
     */
    private static $actions = [
        'reply'  => ['#', 'icon-share'],
        'flag'   => ['#', 'icon-flag'],
        'delete' => ['#', 'icon-remove-circle'],
        'hide'   => ['#', 'icon-eye-close']
    ];
    
    private static $data = [
        'id'         => 0,
        'article_id' => 0,
        'user_id'    => 0,
        'date'       => 0,
        'comment'    => '',
        'reply_to'   => 0,
        'status'     => 0
    ];
    
    public static function open()
    {
        if (Article::allow_comments()) {
            return true;
        }
        return false;
    }
    
    public static function count($article_id = null)
    {
        $article_id = ($article_id === null) ? Article::id() : $article_id;
        return (int)Query::table(static::$table)->where('article_id', $article_id)->count();
    }
    
    /**
     * Note: 'in_reply': 0; is required for threading!
     */
    public static function get_all()
    {
        return Query::table(static::$table)->where('article_id', Article::id())->where('reply_to', 0)->get('id');
    }
    
    /**
     * @ignore
     */
    private static function actions($comment_id, $user_id, $commenter_user_id)
    {
        $buttons = [];
        if ($user_id !== $commenter_user_id && Auth::can('draffft_post_comment') || Auth::is('mod') && static::open())
        {
            $buttons[] = "<a href='" . static::$actions['reply'][0] . "' class='sf-uix-button smaller color-android' data-id='{$comment_id}' data-origin-title='Reply'><i class='" . static::$actions['reply'][1] . "'></i></a>";
        }
        if (Auth::is() && $user_id !== $commenter_user_id)
        {
            $buttons[] = "<a href='" . static::$actions['hide'][0] . "' class='sf-uix-button smaller color-blue' data-id='{$comment_id}' data-origin-title='Hide'><i class='" . static::$actions['hide'][1] . "'></i></a>";
        }
        if (Auth::is() && $user_id !== $commenter_user_id)
        {
            $buttons[] = "<a href='" . static::$actions['flag'][0] . "' class='sf-uix-button smaller color-red' data-id='{$comment_id}' data-origin-title='Flag'><i class='" . static::$actions['flag'][1] . "'></i></a>";
        }
        if ($user_id == Article::author() || Auth::is('mod') || Auth::can('draffft_delete_comment'))
        {
            $buttons[] = "<a href='" . static::$actions['delete'][0] . "' class='sf-uix-button smaller color-red' data-id='{$comment_id}' data-origin-title='Delete'><i class='" . static::$actions['delete'][1] . "'></i></a>";
        }
         
        return implode(PHP_EOL, $buttons);
    }
    
    public static function is_threaded($comment_id)
    {
        return static::where('reply_to', $comment_id)->count();
    }
    
    private static function get_threaded($comment_id)
    {
        return static::where('reply_to', $comment_id)->fetch()['id'];
    }
    
    public static function show($comment_id)
    {
        $comment = static::get($comment_id);
        
        $commenter = User::find($comment['user_id']);
        ?>
        <div id="<?=$comment['id'];?>" class="article-comments-container clr <?=((int)$comment['reply_to'] !== 0 ? 'in-reply' : false);?>">
            <div class="comment-author-avatar-container">
                <img src="<?=User::avatar($commenter['username']);?>" alt="<?=$commenter['first'];?>'s Avatar"/>
            </div>
            <div class="article-comment-data">
                <h4 class="comment-author-name clr">
                    <?php //<a href="mailto:<?=$commenter['email'];" title="Email me!"><?="{$commenter['first']} {$commenter['last']} ({$commenter['username']})";</a> ?>
                    <span><?="{$commenter['first']} {$commenter['last']} ({$commenter['username']})";?></span>
                    <?php if (Auth::can('draffft_delete_comment')) : ?>
                    <i class="icon-remove-circle delete-comment"></i>
                    <?php endif; ?>
                    <?php if (User::id() == $comment['user_id'] || Auth::can('draffft_edit_comment')) : ?>
                    <!--i class="icon-pencil edit-comment"></i-->
                    <?php endif; ?>
                </h4>
                <h5 class="comment-time"><?=Time::stamp($comment['date'], 'short');?> (<em><?=Time::since($comment['date']);?></em>)</h5>
                <div class="comment-author-comment"><?=$comment['comment'];?></div>
            </div>
        </div>
        <?php
        if (static::is_threaded($comment['id'])) {
            static::$threaded_count++;
            static::show(static::get_threaded($comment['id']));
        }
    }
    
    public static function get($comment_id)
    {
        return static::where('id', $comment_id)->fetch();
    }
    
}
