<?php
namespace Soule\Applications\Draffft\Models;
/**
 * @package 	Draffft
 * @subpackage	Models
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 */

class Articles_Model
{
	
	private static $db;
	
	public function __construct(\Soule\SQL $db)
	{
		static::$db = $db;
	}
	
	public static function get_articles($limit = '')
	{
		return static::$db->query("SELECT * FROM `" . DTPRE . "articles` AS `articles` ORDER BY `articles`.`date` DESC{$limit}");
	}
	
	public static function total_articles()
	{
		return static::$db->num(static::get_articles());
	}
	
	public static function article_comment_count($article_id)
	{
		return static::$db->nq("SELECT `id` FROM `" . DTPRE . "comments` WHERE `article_id`='{$article_id}'");
	}
	
	public static function article_likes($article_id)
	{
	    return static::$db->nq("SELECT `like_id` FROM `" . DTPRE . "likes` WHERE `article_id` = '{$article_id}'");
	}
	
}
