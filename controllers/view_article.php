<?php
/**
 * @package 	Draffft
 * @subpackage	Controllers
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 *
use Soule\Applications\Draffft\Models\View_Article_Model as Article;

if($uri->in_slug(1, '') && $draffft->is_valid_article($uri->get_slug(1)))
{
	if(is_numeric($uri->get_slug(1)) || preg_match("#^\d+$#", $uri->get_slug(1)))
	{
		$article_slug 	= $draffft->get_slug($uri->get_slug(1));
		$article_id 	= $draffft->get_id($article_slug);
	} else {
		$article_id 	= $draffft->get_id($uri->get_slug(1));
		$article_slug 	= $draffft->get_slug($article_id);
	}
}

require $application->model('view_article');
//$model = new Article($article_id, $db);

$article 	   = Article::get_article($article_id, $db);

$application->set_app_title($article['title']);
$application->set_app_description(substr(trim(strip_tags($article['body'])), 0, 200));

$author 	   = $auth->get_user((int)$article['user_id']);
$comments	   = Article::get_comments();
$comment_count = Article::get_comment_count();

$auth->set_user_status($auth->get_user_info('id'), 1, $uri->get_url());

require $application->render('view_article');
*/