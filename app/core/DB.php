<?php

class DB {
    
    private $connection;

    function __construct() {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $dbname = env('DB_NAME');
        $user = env('DB_LOGIN');
        $password = env('DB_PASSWORD');
        $connection_string = 'host='.$host
        .' port='.$port 
        .' dbname='.$dbname 
        .' user='.$user 
        .' password='.$password;
        $this->connection = pg_connect($connection_string);
    }

    function query($sql) {
        return pg_query($this->connection,$sql);
    }

}