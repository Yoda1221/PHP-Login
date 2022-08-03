<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;

class SiteController extends Controller {

    public static function home() {

        $params = [
            'name' => "Yoda"
        ];
        // $this->render
        return Application::$app->router->renderView('home', $params);

    }

}
