<?php

Route::get('/login','Auth','login');
Route::get('/test','Test');
Route::get('/admin/register','Admin','register');
Route::get('/admin','Admin');
Route::get('/admin/unregister','Admin','unregister');
Route::get('/admin/addkim','Kim','addkim');
Route::get('/admin/delkim','Kim','delkim');
Route::post('/admin/delkim/','Kim');
Route::get('/admin/results','Admin','results');
Route::get('/debug','Debug');
Route::post('/debug/send','Debug','debug');
Route::get('/admin/results/{param}','Admin','single_result');