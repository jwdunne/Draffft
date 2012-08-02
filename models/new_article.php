<?php

class Draffft_New_Article_Model {
	
	private $db;
	private $user_id;
	
	public function __construct($db, $user_id) {
		$this->db = $db;
		$this->user_id = $user_id;
	}
	
	public function cat_article($post) {
		require_once SF_LIB . 'SF_Parse.class.php';
		$parser = new SF_Parse();
		
		$this->db->query("
			INSERT INTO `".DTPRE."articles` (
				`id`,
				`user_id`,
				`date`,
				`title`,
				`description`,
				`body`,
				`slug`,
				`show_about`
			) VALUES (
				NULL,
				'{$this->user_id}',
				UNIX_TIMESTAMP(),
				'" . $this->db->res($post['title']) . "',
				'" . $this->db->res($post['desc']) . "',
				'" . $this->db->res($parser->parse_style($post['body'])) . "',
				'" . SF_URI::new_slug($post['title']) . "',
				'1'
			)
		");
		if($this->db->last_id !== null) {
			$this->db->query("
				INSERT INTO `".DTPRE."categories`
				VALUES(0, '{$post['cat']}', '{$this->db->last_id}')
			");
			if($this->db->last_id !== null) {
				return true;
			}
		} else {
			return false;
		}
	}
	
}