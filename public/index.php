<?php
include '../app/Route.php';
if($_SERVER['REQUEST_URI']=='/') {
    header('Location: /login');
}

include '../config/routes.php';

Route::run();