<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\core\Application;
use App\controllers\SiteController;

$app = new Application(dirname(__DIR__));

//**    GET METHODS
$app->router->get('/', 'home');
$app->router->get('/login', 'login');

//**    POST METHODS
$app->router->post('/login', function() { return "SUBMIT FORM"; });

$app->run();


// function() { return "SUBMIT"; }
// [SiteController::class, 'loginPost']