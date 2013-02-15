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
    
    
    return Response::redirect(Application::link());
});
