<?php

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

/* load routes */
(require __DIR__ . '/../src/Routes/api.php')($app);
(require __DIR__ . '/../src/Routes/web.php')($app);

$app->run();