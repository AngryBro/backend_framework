<?php
include '../app/Route.php';
if($_SERVER['REQUEST_URI']=='/') {
    header('Location: /login');
}

Route::add('/login','Auth','login');
Route::add('/test','Test');
Route::add('/admin/register','Admin','register');
Route::add('/admin','Admin');
Route::add('/admin/unregister','Admin','unregister');

Route::run();