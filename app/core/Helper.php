<?php

abstract class Helper{
    static function include($name) {
        include config('file')['helpers'].$name.'.php';
    }
}