<?php
/**
 * @package 	Draffft
 * @subpackage	Controllers
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 *
 * $Id: view_article.php 29 2012-05-28 22:14:53Z Devon $
 * $Revision: 29 $
 */

if($uri->in_slug(1, '') && $draffft->is_valid_article($uri->get_slug(1))) {
	if(is_numeric($uri->get_slug(1)) || preg_match("#^\d+$#", $uri->get_slug(1))) {
		$article_slug 	= $draffft->get_slug($uri->get_slug(1));
		$article_id 	= $draffft->get_id($article_slug);
	} else {
		$article_id 	= $draffft->get_id($uri->get_slug(1));
		$article_slug 	= $draffft->get_slug($article_id);
	}
}
require_once $application->model('view_article');
$model = new DT_View_Article_Model($article_id, $db);

$article 	= $model->get_article();
$title 		= $article['title'];
$description= substr(trim(strip_tags($article['body'])), 0, 150);

$author 	= $auth->get_user((int)$article['user_id']);
$comments	= $model->get_comments();
$comment_count = (int)$db->num($comments);

$auth->set_user_status($auth->get_user_info('id'), 1, $uri->get_url());

require_once $application->render('view_article');