<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Soule
 * @version    2.0
 * @copyright  2011 - 2012 (c) devxdev.com
 * @license    http://soule.io/license
 * @author     Soule
 * @link       http://soule.io/
 * @since      1.0
 * @filesource
 */
define('DT_PRE',         DB_PRE  . 'draffft_');
define('DT_CONFIG',      DT_BASE . 'config' . DS);
define('DT_MODELS', 	 DT_BASE . 'models' . DS);

/*
 * Database Tables
 */
define('DT_ARTICLES_TABLE',   DT_PRE . 'articles');
define('DT_CATEGORIES_TABLE', DT_PRE . 'categories');
define('DT_TAGS_TABLE',       DT_PRE . 'tags');
define('DT_COMMENTS_TABLE',   DT_PRE . 'comments');
define('DT_LIKES_TABLE',      DT_PRE . 'likes');
define('DT_PINGBACK_TABLE',   DT_PRE . 'pingback');

Soule\IO\Autoloader::alias(DT_CONFIG);
Soule\IO\Autoloader::directory(DT_BASE, DT_MODELS);
define('DT_CONFIGED', true);
