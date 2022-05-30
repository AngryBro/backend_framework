<?php

Route::add('/login','Auth','login');
Route::add('/test','Test');
Route::add('/admin/register','Admin','register');
Route::add('/admin','Admin');
Route::add('/admin/unregister','Admin','unregister');
Route::add('/admin/addkim','Kim','addkim');
Route::add('/admin/delkim','Kim','delkim');
Route::add('/admin/results','Admin','results');
Route::add('/debug','Debug');
Route::add('/admin/results/{param}','Admin','single_result');