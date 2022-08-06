<?php

namespace App\core;

use App\middlewares\AuthMiddleware;
use App\core\exceptions\NotFoundExc;

/**
 ** Class Router
 *
 */
class Router {

    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request  = $request;
        $this->response = $response;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }
    
    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->methods();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            throw new NotFoundExc();            
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            //$callback[0] = new $callback[0]();
            //Application::$app->controller = new $callback[0]();
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->page = $callback[1];
            $callback[0] = $controller;
            foreach ($controller->registerMiddleware() as $middleware) {
                $middleware->execute();
            }

        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = []) {
        $layoutContent  = $this->layoutContent();
        $viewContent    = $this->renderOnlyView($view, $params);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent) {
        $layoutContent  = $this->layoutContent();
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }
    
    protected function layoutContent() {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}
