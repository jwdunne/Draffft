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
use Soule\Application\Application,
    Soule\Application\Settings,
    Soule\Application\View,
    Soule\HttpKernel\Route,
    Soule\HttpKernel\Response;

if (!defined('DT_CONFIGED'))
{
	define('DT_BASE',   pathinfo(__FILE__)['dirname'] . DS);
	require DT_BASE . 'config' . DS . 'config.php';
}

Route::get(['/', 'articles', 'home'], function() {
    
    $title = ucwords(Application::get_data('name')) . ' | ' . Settings::read('site_name');

    return View::make('articles')
        ->add('meta', 'meta', ['title' => $title]);
});

Route::get(['new'], function() {
    
    return View::make('article/new');
    
});

Route::get(['edit/(:num)-(:any)'], function() {
    
    
    return View::make('article/edit');
    
});

Route::get(['article/(:num)-(:any)'], function() {
    
    
    return View::make('article/view');
    
});

/*
if($uri->in_slug(1, 'new')) {
	require_once $application->controller('new_article');
} elseif($uri->in_slug(1)) {
	require_once $application->controller('view_article');
} else {
    require_once $application->controller('articles');
}
*/