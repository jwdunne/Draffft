<?php
use Soule\Applications\Draffft\Models\Articles_Model as Articles;

/**
 * @package 	Draffft
 * @subpackage	Models
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 */

/*
require_once $application->model('articles');

$model = new Articles($db);


$application->set_app_title(Settings::read('draffft_name'));
$application->set_app_description(Settings::read('draffft_slogan'));

/**
 * Setup the pagination
 *
$paginate->set_items_total(Articles::total_articles())->paginate();
/**
 * Get the posts for this thread, and add the pagination LIMIT
 *
$articles = Articles::get_articles($paginate->get_limit());

require $application->render('articles');
*/