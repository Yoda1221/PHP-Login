<?php

namespace App\core\form;

use App\core\Model;

class Form {

    public static function begin($action, $method) {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end() {
        return '</form>';
    }

    public function field(Model $model, $attr) {
        return new Field($model, $attr);
    }

}
