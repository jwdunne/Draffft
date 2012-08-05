<?php
namespace Draffft;
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Soule
 * @subpackage Soule.Applications.Draffft
 * @version    1.0.0
 * @copyright  2011 - 2012 (c) devxdev.com
 * @license    Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0.html>
 * @author     Soule
 * @link       http://soule.io/
 * @since      1.0.0
 * @filesource
 */
defined('DT_EXEC') or die('You cannot access this script directly!');
/**
 * Draffft Class
 * Main object for the Draffft Application.
 *
 * @package     Soule.Applications.Draffft
 * @subpackage  Libs
 * @category    Classes
 * @author      Soule
 * @version     1.0.0
 */
class Draffft
{
	
	private $db;
	
	
	public function __construct(\Soule\SQL $db) {
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