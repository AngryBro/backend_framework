<?php

// Assets routes

Route::get('/img/{name}/{extension}','Assets','img');
Route::get('/js/{script}','Assets','js');
Route::get('/css/{style}','Assets','css');

//

// Default route

Route::default('/login');

//

// GET routes

Route::get('/login','Auth');
Route::get('/logout','Auth','logout');
Route::get('/slogout','Auth','silent_logout');
Route::get('/test','TestWeb');
Route::get('/startexam','TestWeb','start');
Route::get('/admin/register','Auth','registerView');
Route::get('/admin','Admin');
Route::get('/admin/unregister','Admin','unregisterView');
Route::get('/admin/addkim','Kim','addkim');
Route::get('/admin/delkims','Kim','delkims');
Route::get('/api/kims','KimApiController');
Route::get('/admin/results','Admin','results');
Route::get('/admin/results/{result}','Admin','single_result');
Route::get('/api/users','AdminApiController');
Route::get('/test/download/{filename}/{extension}','TestWeb','download');
Route::get('/test/saved','TestWeb','getSavedAns');
Route::get('/debug','DebugController');
Route::get('/api/kim','TestApi','kimName');
Route::get('/api/tasks','TestApi','kimTasks');
Route::get('/api/task/{number}','TestApi','taskImg');
Route::get('/api/results','ResultApiController','results');
Route::get('/api/result/{number}','ResultApiController','result');

//

//POST routes

Route::post('/admin/delkims','Kim','deleteKims');
Route::post('/api/results','ResultApiController','delete');
Route::post('/test','TestWeb','send');
Route::post('/login','Auth','login');
Route::post('/admin/unregister','Admin','unregister');
Route::post('/admin/register','Auth','register');
Route::post('/admin/addkim','Kim','add');
Route::post('/test/save','TestWeb','save');

//

// VIEW routes

Route::view('/info','sample');

//