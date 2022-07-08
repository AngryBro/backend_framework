<?php

class Request {

    private $data;

    function __construct($data) {
        $this->data = $data;
    }

    function json($toObj = true) {
        return json_decode($this->data['json'],$toObj);
    }

    function rawData() {
        return $this->data;
    }

    function validate($rules) {
        $data = $this->data;
        $errors = [];
        foreach($rules as $key => $rule) {
            $errors[$key] = false;
            foreach($rule as $subrule) {
                $rule_name = explode(':',$subrule);
                switch($rule_name[0]) {
                    case 'required': {
                        if(!$this->required($key)) {
                            $errors[$key] = true;
                        }
                        $data[$key] = trim($this->data[$key]);
                        break;
                    }
                    case 'email': {
                        if(!$this->email($key)) {
                            $errors[$key] = true;
                        }
                        $data[$key] = trim($this->data[$key]);
                        break;
                    }
                    case 'text': {
                        $data[$key] = $this->text($key);
                    }
                    case 'minlen': {
                        if(!$this->minlen($key,(int)$rule_name[1])) {
                            $errors[$key] = true;
                        }
                        $data[$key] = trim($this->data[$key]);
                        break;
                    }
                    case 'maxlen': {
                        if(!$this->maxlen($key,(int)$rule_name[1])) {
                            $errors[$key] = true;
                        }
                        $data[$key] = trim($this->data[$key]);
                        break;
                    }
                    case 'min': {
                        $min = (int)$rule_name[1];
                        $number = (int)$this->data[$key];
                        if($number<$min) {
                            $errors[$key] = true;
                        }
                        $data[$key] = $number;
                        break;
                    }
                    case 'max': {
                        $max = (int)$rule_name[1];
                        $number = (int)$this->data[$key];
                        if($number>$max) {
                            $errors[$key] = true;
                        }
                        $data[$key] = $number;
                        break;
                    }
                }
            }
        }
        foreach($errors as $value) {
            if($value) {
                responseJSON(['ok' => false, 'errors' => $errors],422);
                exit;
            }
        }
        return $data;
    }

    private function required($key) {
        return !empty($this->data[$key])&&(!empty(trim($this->data[$key])));
    }

    private function email($key) {
        return filter_var($this->data[$key],FILTER_VALIDATE_EMAIL)!==false;
    }

    private function text($key) {
        return trim(filter_var($this->data[$key],FILTER_SANITIZE_STRING));
    }

    private function minlen($key,$count) {
        $post = trim($this->data[$key]);
        return strlen($post)>=$count;
    }

    private function maxlen($key,$count) {
        $post = trim($this->data[$key]);
        return strlen($post)<=$count;
    }

}