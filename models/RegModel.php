<?php

namespace App\models;

use App\core\Model;

class RegModel extends Model {

    public string $email;
    public string $password;
    public string $confirmPassword;

    public function register() {
        echo "New user is created";
    }

}