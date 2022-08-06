<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;

class SiteController extends Controller {

    public static function home() {
        $name = Application::$app->user->email ?? "";
        $params = [
            'name' => $name
        ];
        // $this->render
        return Application::$app->router->renderView('home', $params);

    }

}
