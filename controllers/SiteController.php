<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Application;
use App\middlewares\AuthMiddleware;

class SiteController extends Controller {

    public function __construct() {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'protected']));
    }

    public static function home() {
        $name = Application::$app->user->email ?? "";
        $params = [
            'name' => $name
        ];
        // $this->render
        return Application::$app->router->renderView('home', $params);

    }

    public function profile() {
        return Application::$app->router->renderView('profile');
    } 
    
    public function protected() {
        return Application::$app->router->renderView('protected');
    }

}
