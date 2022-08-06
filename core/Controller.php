<?php

namespace App\core;

use App\core\Application;
use App\middlewares\AuthMiddleware;

class Controller {

    /**
     * @var App\middlewares\AuthMiddleware[]
     */
    public array $middlewares = [];
    public string $page = '';

    public function __construct() {
        echo 123;
        exit;
    }

    public function render($view, $params) {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(AuthMiddleware $middleware) {
        $this->middlewares[] = $middleware;
        
    }
}
