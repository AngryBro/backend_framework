<?php

class Test1  extends Model {

    function __construct() {
        $this->table = 'users';
    }

    function getUsers() {
        $result = $this->query()
        ->update(['kim' => "'demo1'"])
        ->where(["kim='demo'"])
        ->send();
        return $result;
    }
}