<?php
include '../app/Route.php';
if($_SERVER['REQUEST_URI']=='/') {
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['role']);
    header('Location: /login');
}

include '../config/routes.php';

Route::run();