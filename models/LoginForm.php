<?php

namespace App\models;

use App\core\Model;
use App\models\User;
use App\core\Application;

class LoginForm extends Model {

    public string $email    = "";
    public string $password = "";

    public function login() {
        $find = new User();
        $user = $find->findUser(['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'User does not exist thos e-mail address!');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('email', 'Something went wrong try again!');
            return false;
        }
        return Application::$app->login($user);
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array  {
        return [
            "email" => "Your e-mail address",
            "password" => "Password"
        ];
    }
    
}
