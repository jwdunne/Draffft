<?php
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

class DT_View_Article_Model {
	
	public 	$article_id;
	private $db;
	public 	$author_id;
	private $comment_count;
	private $threaded_count = 0;
	
	public function __construct($article_id, $db) {
		$this->article_id = $article_id;
		$this->db = $db;
	}
	
	public function get_article() {
		$article = $this->db->fq("
			SELECT
				*
			FROM
				`".DTPRE."articles` AS `articles`
			INNER JOIN
				`".DTPRE."categories` AS `categories`
			ON
				`articles`.`category_id` = `categories`.`id`
			WHERE
				`articles`.`id` = {$this->article_id}
			LIMIT 1
		");
		$this->author_id = $article['user_id'];
		
		return $article; 
	}
	
	public function get_comments() {
		return $this->db->query("SELECT * FROM `" . DTPRE . "comments` WHERE `article_id`='{$this->article_id}' AND `reply_to`='0'");
	}
	
	public function get_comment_count() {
		return $this->comment_count = $this->db->num($this->get_comments());
	}
	
	public function get_threaded_comment($parent_id) {
		$replies = $this->db->query("SELECT * FROM `" . DTPRE . "comments` WHERE `article_id`='{$this->article_id}' AND `reply_to`='{$parent_id}'");
		if((int)$this->db->num($replies) !== 0) {
			return $replies;
		} else {
			return false;
		}
	}
	
	public function get_tags() {
		
	}
	
	public function show_comments($comments) {
		global $auth, $uri;
		while($comment = $this->db->fassoc($comments)) :
			$c_user = $auth->get_user((int)$comment['user_id']);
		?>
		<?php if((int)$comment['status'] == 0) : ?>
		<div class="article-comment-spam">
			<div class="spam-warning">
				<h4>This comment has been marked as spam by the community.</h4>
				<div class="article-comment-actions">
					<input type="button" data-id="<?=$comment['id']?>" class="sf-uix-button color-blue show" value="Show" />
				</div>
			</div>
		<?php endif; ?>
		<div id="<?=$comment['id']?>" class="article-comment-wrapper clr<?=((int)$comment['status'] == 0 ? ' spam' : false)?><?=((int)$comment['reply_to'] !== 0 ? " in-reply reply-num-{$this->threaded_count}" : false);?><?=((int)$comment['user_id'] == $this->author_id ? ' author' : false);?>">
			<div class="article-author-image-border">
				<img src="<?=$auth->user_avatar($c_user['username'])?>" alt="" />
			</div>
			<div class="article-comment-data">
				<h3 class="article-comment-username"><?=($c_user['username'] == $auth->get_user_info('username') ? 'You' : "{$c_user['first']} {$c_user['last']} ({$c_user['username']})");?><?=((int)$comment['user_id'] == $this->author_id ? '<span class="comment-author-block">author</span>' : false);?></h3>
				<h4 class="article-comment-timestamp"><?=(time_since($comment['date']));?></h4>
				<p><?=$comment['comment']?></p>
				<div class="article-comment-actions">
					<?php if((int)$auth->get_user_info('id') !== (int)$c_user['id'] && $auth->can('draffft_post_comment') || $auth->is_authd('mod')) :?>
					<input type="button" data-id="<?=$comment['id']?>" class="sf-uix-button color-android" value="Reply" />
					<?php endif; ?>
					<?php if($auth->get_user_info('id') == $this->author_id || $auth->is_authd('mod') || $auth->can('draffft_delete_comment')) : ?>
					<input type="button" data-id="<?=$comment['id']?>" class="sf-uix-button color-red delete" value="Delete" />
					<?php elseif($auth->is_authd() && (int)$auth->get_user_info('id') !== (int)$c_user['id']) : ?>
					<input type="button" data-id="<?=$comment['id']?>" class="sf-uix-button color-red flag" value="Flag" />
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php if((int)$comment['status'] == 0) : ?>
		</div>
		<?php endif; ?>
		<?php 
		if($this->get_threaded_comment($comment['id']) !== false) {
			$this->threaded_count++;
			$this->show_comments($this->get_threaded_comment($comment['id']));
		}
		endwhile;
	}
	
}