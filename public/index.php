<?php
include '../app/Route.php';

Route::add('/login','Auth','loginView');
Route::add('/test','Test');
Route::add('/admin/register','Auth','registerView');
Route::add('/admin/register/submit','Auth','register');
Route::add('/login/submit','Auth','login');
Route::add('/admin','Admin','view');
Route::add('/admin/unregister','Admin','unregView');
Route::add('/admin/unregister/submit','Admin','unregister');

Route::run();