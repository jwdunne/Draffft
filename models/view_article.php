<?php
namespace Soule\Applications\Draffft\Models;
/**
 * @package 	Draffft
 * @subpackage	Models
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 *
 * $Id: view_article.php 25 2012-05-17 18:13:30Z Devon $
 * $Revision: 25 $
 */

class View_Article_Model
{
	
	public static $article_id;
	
	public static $author_id;
	
	private static $db;
	
	private static $comment_count;
	
	private static $threaded_count = 0;
	
	public static function get_article($article_id, \Soule\SQL $db)
	{
	    static::$article_id = $article_id;
	    static::$db = $db;
	    
		$article = static::$db->fq("
			SELECT
				*
			FROM
				`" . DTPRE . "articles` AS `articles`
			INNER JOIN
				`" . DTPRE . "categories` AS `categories`
			ON
				`articles`.`category_id` = `categories`.`id`
			WHERE
				`articles`.`id` = '{$article_id}'
			LIMIT 1
		");
		static::$author_id = $article['user_id'];
		
		return $article;
	}
	
	public static function get_comments()
	{
		return static::$db->query("SELECT * FROM `" . DTPRE . "comments` WHERE `article_id`='" . static::$article_id . "' AND `reply_to`='0'");
	}
	
	public static function get_comment_count()
	{
		return static::$comment_count = static::$db->num(static::get_comments());
	}
	
	public static function get_threaded_comment($parent_id)
	{
		$replies = static::$db->query("SELECT * FROM `" . DTPRE . "comments` WHERE `article_id`='" . static::$article_id . "' AND `reply_to`='{$parent_id}'");
		if(static::$db->num($replies) !== 0) {
			return $replies;
		} else {
			return false;
		}
	}
	
	public static function get_tags()
	{
		// XXX probably not going to use article tags.
	}
	
	public static function show_comments($comments)
	{
		global $auth, $uri;
		while($comment = static::$db->fassoc($comments)) :
			$c_user = $auth->get_user((int)$comment['user_id']);
		?>
		<?php if((int)$comment['status'] == 0) : ?>
		<div class="article-comment-spam">
			<div class="spam-warning">
				<h4>This comment has been marked as spam by the community.</h4>
				<div class="article-comment-actions">
					<a data-id="<?=$comment['id']?>" class="sf-uix-button color-blue smaller show">
					    <i class="icon-eye-open"></i>
					</a>
				</div>
			</div>
		<?php endif; ?>
		<div id="<?=$comment['id']?>" class="article-comment-wrapper clr<?=((int)$comment['status'] == 0 ? ' spam' : false)?><?=((int)$comment['reply_to'] !== 0 ? " in-reply reply-num-" . static::$threaded_count : false);?><?=((int)$comment['user_id'] == static::$author_id ? ' author' : false);?>">
			<div class="article-author-image-border">
				<img src="<?=$auth->user_avatar($c_user['username'])?>" alt="" />
			</div>
			<div class="article-comment-data">
				<h3 class="article-comment-username"><?=($c_user['username'] == $auth->get_user_info('username') ? 'You' : "{$c_user['first']} {$c_user['last']} ({$c_user['username']})");?><?=((int)$comment['user_id'] == static::$author_id ? '<span class="comment-author-block">author</span>' : false);?></h3>
				<h4 class="article-comment-timestamp"><?=(time_since($comment['date']));?></h4>
				<p><?=$comment['comment'];?></p>
				<div class="article-comment-actions">
				    <?=static::comment_actions($comment['id'], (int)$auth->get_user_info('id'), (int)$c_user['id']);?>
				</div>
			</div>
		</div>
		<?php if((int)$comment['status'] == 0) : ?>
		</div>
		<?php endif; ?>
		<?php
		if(static::get_threaded_comment($comment['id']) !== false) :
			static::$threaded_count++;
			static::show_comments(static::get_threaded_comment($comment['id']));
		endif;
		endwhile;
	}
	
	private static function comment_actions($comment_id, $user_id, $commenter_user_id)
	{
	    global $auth;
	    $action = [
            'reply'  => ['#', 'icon-share'],
            'flag'   => ['#', 'icon-flag'],
            'delete' => ['#', 'icon-remove-circle'],
            'hide'   => ['#', 'icon-eye-close']
        ];
	    if ($user_id !== $commenter_user_id && $auth->can('draffft_post_comment') || $auth->is_authd('mod')) :
	        $buttons[] = "<a href='{$action['reply'][0]}' class='sf-uix-button smaller color-android' data-id='{$comment_id}' data-origin-title='Reply'><i class='{$action['reply'][1]}'></i></a>";
	    endif;
	    if ($auth->is_authd() && $user_id !== $commenter_user_id) :
	    $buttons[] = "<a href='{$action['hide'][0]}' class='sf-uix-button smaller color-blue' data-id='{$comment_id}' data-origin-title='Hide'><i class='{$action['hide'][1]}'></i></a>";
	    endif;
	    if ($auth->is_authd() && $user_id !== $commenter_user_id) :
	        $buttons[] = "<a href='{$action['flag'][0]}' class='sf-uix-button smaller color-red' data-id='{$comment_id}' data-origin-title='Flag'><i class='{$action['flag'][1]}'></i></a>";
	    endif;
	    if ($user_id == static::$author_id || $auth->is_authd('mod') || $auth->can('draffft_delete_comment')) :
	        $buttons[] = "<a href='{$action['delete'][0]}' class='sf-uix-button smaller color-red' data-id='{$comment_id}' data-origin-title='Delete'><i class='{$action['delete'][1]}'></i></a>";
	    endif;
	    
	    return implode(PHP_EOL, $buttons);
	}
	
}
