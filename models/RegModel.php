<?php

namespace App\models;

use App\core\Model;

class RegModel extends Model {

    public string $email        = '';
    public string $password     = '';
    public string $passwordConf = '';

    public function register() {
        echo "New user is created";
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8]],
            'passwordConf' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

}