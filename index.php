<?php
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