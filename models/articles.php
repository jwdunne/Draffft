<?php
/**
 * @package 	Draffft
 * @subpackage	Models
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 *
 * $Id: articles.php 25 2012-05-17 18:13:30Z Devon $
 * $Revision: 25 $
 */

class DT_Articles_Model {
	
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function get_articles() {
		return $this->db->query("SELECT * FROM `".DTPRE."articles` AS `articles` ORDER BY `articles`.`date` DESC");
	}
	
	public function total_articles() {
		return (int)$this->db->num($this->get_articles());
	}
	
	public function article_comment_count($article_id) {
		$comments = $this->db->query("SELECT `id` FROM `".DTPRE."comments` WHERE `article_id`='{$article_id}'");
		return (int)$this->db->num($comments);
	}
	
}