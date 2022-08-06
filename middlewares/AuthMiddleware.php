<?php

namespace App\middlewares;

use App\core\Application;
use App\core\exceptions\PermDeniedExc;

class AuthMiddleware {
    public array $pages = [];

    public function __construct(array $pages = [] ) {
        $this->pages = $pages;
    }

    public function execute() {
        if (Application::isGuest()) {
            dump(Application::$app->controller->page);
            exit;
            if (empty($this->pages) || in_array(Application::$app->controller->page, $this->pages)) {
                throw new PermDeniedExc();
            }
        }
    }

}
