<?php

namespace App\models;

use App\core\DbModel;

class User extends DbModel {

    public string $email        = '';
    public string $password     = '';
    public string $passwordConf = '';

    public function tableName(): string {
        return 'users';
    }

    public function save() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8]],
            'passwordConf' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function Attributes() : array {
        return ['email', 'password'];
    }

}