<?php

Route::get('about-us', function() {
    
    
    return View::make('about-us')
        ->add('meta', 'meta', ['title' => 'About the Staff'])
        ->add('footer', 'footer');
});

Route::get('contact-us', function() {

    return View::make('contact-us')
        ->add('meta', 'meta', ['title' => 'Contact the WeLoveProgramming.org Staff'])
        ->add('footer', 'footer');
});

Route::post('contact-us', function() {
   
   Query::table('contact_us', DB_PRE)->insert($_POST);
    
    return Response::redirect(Application::link());
});

Route::get('privacy', function() {
    return View::make('privacy')
        ->add('meta', 'meta', ['title' => 'WeLoveProgramming.org\'s Privacy Policy']);
});

Route::get(['tos', 'terms'], function() {
    return View::make('tos')
        ->add('meta', 'meta', ['title' => 'WeLoveProgramming\'s Terms of Service']);
});
