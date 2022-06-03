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
Route::get('/admin/results/{param}','Admin','single_result');
Route::get('/debug/{param}/dynamic/{param}','Debug');
Route::get('/admin/unregister/users','Admin','getUsers');

Route::post('/admin/delkim/delete','Kim','deleteKims');
Route::post('/debug/send','Debug','debug');
Route::post('/admin/results/delete','Admin','deleteResults');
Route::post('/login/authentificate','Auth','authentificate');
Route::post('/admin/unregister/delete','Admin','deleteUsers');