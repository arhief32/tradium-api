<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

/* middleware parsing body json */
$app->addBodyParsingMiddleware();

/* load helper */
require __DIR__ . '/../src/helpers.php';

/* load routes */
(require __DIR__ . '/../src/routes.php')($app);

$app->run();