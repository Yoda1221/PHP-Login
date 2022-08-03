<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\core\Application;
use App\controllers\SiteController;
use App\controllers\AuthController;

$app = new Application(dirname(__DIR__));

//** SITES
$app->router->get('/', [SiteController::class, 'home']);


//** AUTH
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/registration', [AuthController::class, 'registration']);
$app->router->post('/registration', [AuthController::class, 'registration']);

$app->run();


// function() { return "SUBMIT"; }
// [SiteController::class, 'loginPost']