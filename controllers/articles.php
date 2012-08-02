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


require_once $application->model('articles');
$model = new DT_Articles_Model($db);

$articles = $model->get_articles();
$title = $core->settings('draffft_name');
require_once $application->render('articles');