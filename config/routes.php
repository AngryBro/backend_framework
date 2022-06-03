<?php

Route::get('/login','Auth','login');
Route::get('/test','Test');
Route::get('/admin/register','Admin','register');
Route::get('/admin','Admin');
Route::get('/admin/unregister','Admin','unregister');
Route::get('/admin/addkim','Kim','addkim');
Route::get('/admin/delkims','Kim','delkims');
Route::get('/admin/delkims/getkims','Kim','getkims');
Route::get('/admin/results','Admin','results');
Route::get('/admin/results/getresults','Admin','getResults');
Route::get('/debug','Debug');
Route::get('/admin/results/{param}','Admin','single_result');

Route::post('/admin/delkim/delete','Kim','deleteKims');
Route::post('/debug/send','Debug','debug');
Route::post('/admin/results/delete','Admin','deleteResults');