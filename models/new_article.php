<?php
namespace \Soule\Applications\Draffft\Models;

class New_Article_Model
{
	
	private $db;
	
	private $user_id;
	
	public function __construct(\Soule\SQL $db, $user_id)
	{
		$this->db = $db;
		$this->user_id = $user_id;
	}
	
	public function cat_article($post)
	{
	    global $uri;
		$parser = new \Soule\Parse();
		
		// XXX Almost 100% sure its supposed to be blog/(:num){1,}-(:any) for slugs
		$this->db->query("
			INSERT INTO `" . DTPRE . "articles` (
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
				'" . $uri->create_uri('blog', $post['title']) . "',
				'1'
			)
		");
		if($this->db->last_id !== null) {
			$this->db->query("
				INSERT INTO `".DTPRE."categories`
				VALUES(0, '{$post['cat']}', '{$this->db->last_id}')
			");
			if($this->db->last_id !== null)
			{
				return true;
			}
		} else {
			return false;
		}
	}
	
}
