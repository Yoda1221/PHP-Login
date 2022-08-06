<?php

namespace App\core;

use App\core\Application;
use App\middlewares\AuthMiddleware;

class Controller {

    /**
     * @var App\middlewares\AuthMiddleware[]
     */
    protected array $middlewares = [];
    public string $page = '';

    public function __construct() {}

    public function render($view, $params) {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(AuthMiddleware $middleware) {
        $this->middlewares[] = $middleware;
        
    }

    public function getMiddlewares(): array {
        return $this->middlewares;
    }
}
