<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Draffft
 * @version    1.3
 * @copyright  2011 - 2013 (c) devxdev.com
 * @license    http://soule.io/license
 * @author     Soule
 * @link       http://soule.io/draffft
 * @since      1.0
 */

/*
 * Get the config.
 */
if (!defined('DT_CONFIGED'))
{
	define('DT_BASE',   pathinfo(__FILE__)['dirname'] . DS);
	require DT_BASE . 'config' . DS . 'config.php';
	Application::routes();
}

/* 
 * Don't allow an empty uri. (mostly for Soule\Application\Paginations)
 */
Route::get('/', function() {
    return Response::redirect(Application::link('home', 'page', 1));
});


/*
 * Look for a shortend uri, e.g. wlp.org/blog/2 => wlp.org/blog/view/2-adsfasdf
 */
Route::get(['(:num)', 'articles/(:num)', 'home/(:num)'], function($id) {
    
    $article = Article::get($id);
    
    if ($article !== null && $article !== false) {
        Response::redirect(Application::link('view', "{$id}-{$article['slug']}"));
        
    } else {
        Response::redirect(Application::link('home', 'page', 1));
    }
    
});

/*
 * The apps "homepage".
 */
Route::get(['articles', 'home', 'aticles/page/(:num)', 'home/page/(:num)'], function($page = 1) {
    
    Paginations::make(Article::total(), $page, Settings::read('draffft_articles_per_page'));
    
    return View::make('articles', ['breadcrumbs' => Breadcrumbs::make()])
        ->add('meta',   'meta', ['title' => ucwords(Application::info('public_name'))])
        ->add('footer', 'footer');
});

/*
 * Viewing an article
 */
Route::get(['view/(:num)-(:any)'], function($id, $title) {
    
    /* Inform blogs that they CAN ping this page. */
    Response::header('X-Pingback', Application::link('xmlrpc'));
    
    Article::get($id);
    
    $vars['author']  = Article::author();
    $vars['breadcrumbs'] = Breadcrumbs::make([Article::title() => Uri::current()]);
    
    return View::make('article/view', $vars)
        ->add('meta', 'meta', ['title' => Article::title() . ' | ' . ucwords(Application::info('public_name')), 'meta_vars' => ['<link rel="pingback" href="' . Application::link('xmlrpc') . '" />']])
        ->add('comments', 'article/comments');

});

/*
 * Post the comment
 */
Route::post('comment', function() {
    Comments::insert($_POST);
});

/*
 * Route for reply previews.
 */
Route::get('comment/ajax', function() {
    echo Parser::parse_style($_GET['body'], true);
});

/*
 * View articles in a specific category
 */
Route::get('category/(:num)-(:any)', function($id, $name) {
    
    Category::get($id);
    
    if (!Category::id() || Category::title() != $name) {
        return View::make('error/404', ['item' => "(<strong>Category :: {$id}-{$name}</strong>)"])->add('meta', 'meta', ['title' => "Ivalid Category | Error 404"]);
    } 
    
    return View::make('category')
        ->add('meta', 'meta', ['title' => "All {$name} Articles | " . ucwords(Application::info('public_name'))]);
    
});

/*
 * View articles tagged by X
 */
Route::get('tagged/(:any)', function($tag) {});

/*
 * Create a new Article
 */
Route::get('new', ['before' => 'author', 'do' => function() {
    
    return View::make('article/new')
        ->add('meta', 'meta', ['title' => 'Authoring A New Article | ' . ucwords(Application::info('public_name'))]);
    
}]);

Route::post('new', function() {
    
    return Response::redirect(Application::link(Article::insert($_POST)));
    
});

/*
 * Edit an article
 */
Route::get('edit/(:num)-(:any)', ['before' => 'edit', 'do' => function($id, $title) {
    
    $title = "Editing " . Strings::title($title);
    
    return View::make('article/edit')
        ->add('meta', 'meta', ['title' => $title]);
    
}]);

Route::post('edit', ['before' => 'edit', 'do' => function() {
    
    Article::update($_POST);
    
}]);

/*
 * Pingbacks/Trackbacks
 * @ignore
 */
Route::get(['pingback', 'trackback', 'xmlrpc'], function() {

    Response::header('Content-Type', 'text/xml; charset=UTF-8');
    Response::header('X-Pingback', Application::link('xmlrpc'));
    
    return '<h1>POST is the only supported method for the XMLRPC server</h1>'; //Pingback::unsupported();
    
});

Route::post(['pingback', 'trackback', 'xmlrpc'], function() {
    
    $source = 'http://jameswdunne.com/blog';
    $target = 'http://p9g/draffft/view/1-compile-php-54-on-debian-based-nix';
    
    //Pingback::ping($source, $target);
});

/*
 * RSS
 */
Route::get('feed/(:any)', function($timeline) {
    if ($timeline == 'recent') {
        
    } elseif ($timeline == 'all') {
        
    }
    
    return Response::error(404);
});

/*
 * Login
 */
Route::get('login', function() {
    return Response::redirect(Applicaiton::link('#login'));
});

/**
 * @todo: make Auth::login a single param method.
 *  just move all login INTO the the method.
 */
Route::post('login', function() {
    $remember = (isset($_POST['remember']) && (int)$_POST['remember'] == 1) ? 1 : 0;
    if (Auth::login($_POST['email'], $_POST['password'], $remember)) {
        return Response::redirect(Application::link());
    }
    
    return Response::redirect(Application::link('#login'));
});

/*
 * Registration
 */
Route::get('register', function() {
    Response::redirect(Application::link('#register'));
});

Route::post('register', function() {
    if (Auth::register($_POST)) {
        Auth::login($_POST['email'], $_POST['password']);
        return Response::redirect(Application::link('#succes'));
    } else {
        // email taken..
    }
    // Other failure (app layer)
    return Response::redirect(Application::link('#register'));
});

/*
 * Login
 */
Route::get('logout', function() {
    Auth::logout();
    return Response::redirect(Application::link());
});

/*
 * Catch all
 */
Route::any('*', function() {
    return View::make('error/404', ['item' => ""])
        ->add('meta', 'meta', ['title' => "Error 404"]);
});

/*
 * Filters
 * ['before' => 'FILTER_NAME', 'do' => function() {}]
 */
Route::filter('edit', function() {
    if (!Auth::can('draffft_edit_article')) {
        return Response::redirect(Application::link('#login'));
    }
});

Route::filter('author', function() {
    if (!Auth::can('draffft_create_article')) {
        return Response::redirect(Application::link('#login'));
    }
});

Route::filter('delete', function() {
    if (!Auth::can('draffft_delete_article')) {
        return Response::redirect(Application::link('#login'));
    }
});
