<?php

Route::default('/login');

Route::get('/login','Auth');
Route::get('/logout','Auth','logout');
Route::get('/slogout','Auth','silent_logout');
Route::get('/test','Test');
Route::get('/startexam','Test','start');
Route::get('/test/data','Test','getData');
Route::get('/admin/register','Admin','registerShow');
Route::get('/admin','Admin');
Route::get('/admin/unregister','Admin','unregister');
Route::get('/admin/addkim','Kim','addkim');
Route::get('/admin/delkims','Kim','delkims');
Route::get('/admin/getkims','Kim','getkims');
Route::get('/admin/results','Admin','results');
Route::get('/admin/results/get','Admin','getResults');
Route::get('/admin/results/{result}','Admin','single_result');
Route::get('/admin/users','Admin','getUsers');
Route::get('/test/download/{filename}','Test','download');
Route::get('/test/saved','Test','getSavedAns');
Route::get('/debug','Debug');

Route::post('/admin/delkims','Kim','deleteKims');
Route::post('/debug/send','Debug','debug');
Route::post('/admin/results','Admin','deleteResults');
Route::post('/admin/result','Admin','getResult');
Route::post('/test','Test','send');
Route::post('/login','Auth','authentificate');
Route::post('/admin/unregister','Admin','deleteUsers');
Route::post('/admin/register','Admin','register');
Route::post('/admin/addkim','Kim','add');
Route::post('/test/save','Test','save');