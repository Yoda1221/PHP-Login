<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use App\core\Application;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn'   => $_ENV['DB_DSN'],
        'user'  => $_ENV['DB_USER'],
        'pass'  => $_ENV['DB_PASS']
    ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigration();
