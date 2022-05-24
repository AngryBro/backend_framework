<?php
include '../app/Route.php';
if($_SERVER['REQUEST_URI']=='/') {
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['role']);
    header('Location: /login');
}

Route::add('/login','Auth','login');
Route::add('/test','Test');
Route::add('/admin/register','Admin','register');
Route::add('/admin','Admin');
Route::add('/admin/unregister','Admin','unregister');
Route::add('/admin/addkim','Kim','addkim');
Route::add('/admin/delkim','Kim','delkim');

Route::run();