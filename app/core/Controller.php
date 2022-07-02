<?php

abstract class Controller {
    
    protected function accessOnlyFor($roles) {
        if((!isset($_SESSION['role']))||(!in_array($_SESSION['role'],$roles))) {
            abort(403);
        }
    } 

}