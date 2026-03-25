<?php

use Slim\App;

return function (App $app) {
    $app->get('/', function ($request, $response) {
        $html = file_get_contents(__DIR__ . '/../../frontend/index.html');
        $response->getBody()->write($html);
        return $response;
    });
};