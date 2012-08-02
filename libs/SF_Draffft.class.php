<?php
/**
 * @package 	Draffft
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 *
 * $Id: SF_Draffft.class.php 25 2012-05-17 18:13:30Z Devon $
 * $Revision: 25 $
 */
defined('DT_EXEC') or die('You cannot access this script directly! ' . __FILE__);

class SF_Draffft {
	
	private $db;
	
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function get_slug($slug_val) {
		$slug_val = $this->db->res($slug_val);
		$sql = $this->db->fq("SELECT `slug` FROM `".DTPRE."articles` WHERE `id`='{$slug_val}'");
		if(count($sql) !== 0) {
			return (string)$sql['slug'];
		} else {
			return false;
		}
	}
	
	public function get_id($slug_val) {
		$sql = $this->db->fq("SELECT `id` FROM `".DTPRE."articles` WHERE `slug`='{$slug_val}'");
		if(count($sql) !== 0) {
			return (int)$sql['id'];
		} else {
			return false;
		}
	}
	
	public function is_valid_article($article) {
		$article = $this->db->res($article);
		if(is_numeric($article) || preg_match('#^\d+$#', $article)) {
			$article = (int)$article;
			if($this->db->nq("SELECT `id` FROM `".DTPRE."articles` WHERE `id`='{$article}'") !== 0) {
				return true;
			} else {
				return false;
			}
		} elseif(is_string($article)) {
			if($this->db->nq("SELECT `slug` FROM `".DTPRE."articles` WHERE `slug`='{$article}'") !== 0) {
				return true;
			} else {
				return false;
			}
		} else {
			throw new Exception("Not a valid article\n\Attempted: {$article}");
			return false;
		}
	}
	
}