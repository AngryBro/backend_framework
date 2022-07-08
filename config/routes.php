<?php

// Assets routes

Route::get('/img/{name}/{extension}','Assets','img');
Route::get('/js/{script}','Assets','js');
Route::get('/css/{style}','Assets','css');

//

// Default route

Route::default('/default');

//

// GET routes

Route::get('/default','SampleController','sample');
Route::get('/debug','DebugController');
Route::get('/api/debug','DebugController','apiget');

//

//POST routes

Route::post('/api/debug','DebugController','apiDebug');

//

// VIEW routes

Route::view('/view','sample');

//