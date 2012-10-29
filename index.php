<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Soule
 * @subpackage Soule.Applications.Campr
 * @version    1.0.0
 * @copyright  2011 - 2012 (c) devxdev.com
 * @license    Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0.html>
 * @author     Soule
 * @link       http://soule.io/
 * @since      1.0.0
 * @filesource
 */
defined('SF_EXEC') or die('This applications requires Soule to run!');

define('DT_EXEC', 1);

if(!defined('DT_CONFIGED')) {
	define('DT_BASE', str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__));
	require_once DT_BASE . 'config.php';
}

if($uri->in_slug(1, 'new')) {
	require_once $application->controller('new_article');
} elseif($uri->in_slug(1)) {
	require_once $application->controller('view_article');
} else {
    require_once $application->controller('articles');
}