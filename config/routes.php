<?php

// Assets routes

Route::get('/img/{name}/{extension}','Assets','img');
Route::get('/js/{script}','Assets','js');
Route::get('/css/{style}','Assets','css');

//

Route::default('/login');

Route::get('/login','Auth');
Route::get('/logout','Auth','logout');
Route::get('/slogout','Auth','silent_logout');
Route::get('/test','Test');
Route::get('/startexam','Test','start');
Route::get('/test/data','Test','getData');
Route::get('/admin/register','Auth','registerView');
Route::get('/admin','Admin');
Route::get('/admin/unregister','Admin','unregisterView');
Route::get('/admin/addkim','Kim','addkim');
Route::get('/admin/delkims','Kim','delkims');
Route::get('/admin/getkims','Kim','getkims');
Route::get('/admin/results','Admin','results');
Route::get('/admin/results/get','Admin','getResults');
Route::get('/admin/results/{result}','Admin','single_result');
Route::get('/api/users','AdminApiController','getUsers');
Route::get('/test/download/{filename}/{extension}','Test','download');
Route::get('/test/saved','Test','getSavedAns');
Route::get('/debug','DebugController');

Route::post('/admin/delkims','Kim','deleteKims');
Route::post('/admin/results','Admin','deleteResults');
Route::post('/admin/result','Admin','getResult');
Route::post('/test','Test','send');
Route::post('/login','Auth','login');
Route::post('/admin/unregister','Admin','unregister');
Route::post('/admin/register','Auth','register');
Route::post('/admin/addkim','Kim','add');
Route::post('/test/save','Test','save');