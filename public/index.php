<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\models\User;
use App\core\Application;
use App\controllers\AuthController;
use App\controllers\SiteController;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn'   => $_ENV['DB_DSN'],
        'user'  => $_ENV['DB_USER'],
        'pass'  => $_ENV['DB_PASS']
    ]
];

$app = new Application(dirname(__DIR__), $config);

//** SITES
$app->router->get('/', [SiteController::class, 'home']);

//** AUTH
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/registration', [AuthController::class, 'registration']);
$app->router->post('/registration', [AuthController::class, 'registration']);

$app->run();
