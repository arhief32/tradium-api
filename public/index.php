<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

/* load routes */
(require __DIR__ . '/../src/Routes/api.php')($app);

$app->run();