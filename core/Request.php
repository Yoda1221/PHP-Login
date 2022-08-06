<?php

namespace App\core;


class Request {

    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }
    
    public function methods() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    
    public function isGet() {
        return $this->methods() === 'get';
    }

    public function isPost() {
        return $this->methods() === 'post';
    }
    
    public function getBody() {
        $body = [];

        if ($this->methods() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->methods() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}
