<?php

class Query {

    private $query;
    private $table;
    //private $schema;

    function __construct($table,$query=[]) {
        $this->table = $table;
        $this->query = $query;
        //$this->schema = $schema;
    }

    function insert($array) {
        $this->query = ['insert' => $array];
        return $this;
    }

    function whereIn($array) {
        $this->query['whereIn'] = $array;
        return $this;
    }

    function whereNotIn($array) {
        $this->query['whereNotIn'] = $array;
        return $this;
    }

    function whereNot($array) {
        $this->query['whereNot'] = $array;
        return $this;
    }

    function select($rows = ["*"]) {
        $rows = implode(',',$rows);
        $this->query['select'] = $rows;
        return $this;
    }

    function delete() {
        $this->query['delete'] = true;
        return $this;
    }

    function where($array) {
        $this->query['where'] = $array;
        return $this;
    }

    function update($array) {
        $this->query['update'] = $array;
        return $this;
    }

    function orderBy($column,$asc=true) {
        $this->query['order'] = $column.' '.($asc?'ASC':'DESC');
        return $this;
    }

    function send() {
        $sql = '';
        $query = $this->query;
        if(isset($query['select'])) {
            $sql = 'SELECT '.$query['select'].' FROM '.$this->table;
        }
        if(isset($query['update'])) {
            $sql = 'UPDATE '.$this->table.' SET ';
            $temp = [];
            foreach($query['update'] as $key => $value) {
                array_push($temp,$key.'='.$value);
            }
            $set = implode(',',$temp);
            $sql = $sql.$set;
        }
        if(isset($query['delete'])) {
            $sql = 'DELETE FROM '.$this->table;
        }

        if(isset($query['where'])||
                isset($query['whereIn'])||
                isset($query['whereNot'])||
                isset($query['whereNotIn'])) {
            $temp = [];
            if(isset($query['where'])) {
                foreach($query['where'] as $key => $value) {
                    array_push($temp,$key.'='
                        .("'".$value."'")
                    );
                }
            }
            if(isset($query['whereNot'])) {
                foreach($query['whereNot'] as $key => $value) {
                    array_push($temp,$key.'!='
                        .("'".$value."'")
                    );
                }
            }
            if(isset($query['whereIn'])) {
                foreach($query['whereIn'] as $key => $value) {
                    foreach($value as $sub_key => $str) {
                        $value[$sub_key] = "'".$str."'";
                    }
                    $values_str = implode(',',$value);
                    array_push($temp,$key.' IN ('.$values_str.')');
                }
            }
            if(isset($query['whereNotIn'])) {
                foreach($query['whereNotIn'] as $key => $value) {
                    foreach($value as $sub_key => $str) {
                        $value[$sub_key] = "'".$str."'";
                    }
                    $values_str = implode(',',$value);
                    array_push($temp,$key.' NOT IN ('.$values_str.')');
                }
            }
            $conditions = implode(' AND ',$temp);
            $sql .= ' WHERE '.$conditions;
        }

        if(isset($query['order'])) {
            $sql = $sql.' ORDER BY '.$query['order'];
        }
        if(isset($query['insert'])) {
            $values = [];
            $keys = [];
            foreach($query['insert'] as $key => $value) {
                array_push($keys,$key);
                array_push($values,"'".$value."'");
            }
            $values = implode(',',$values);
            $keys = implode(',',$keys);
            $sql = "INSERT INTO ".$this->table." (".$keys.") VALUES (".$values.")";
        }
        $DB = new DB;
        $sql = str_replace("'DEFAULT'","DEFAULT",$sql);
        $result = $DB->query($sql);
        $result = pg_fetch_all($result);
        $response = [
            'ok' => $result!==false,
            'empty' => true,
            'data' => []
        ];
        if(!empty($result)) {
            $response['empty'] = false;
            $response['data'] = $result;
        }
        return $response;
    }
}