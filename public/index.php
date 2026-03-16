<?php

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->get('/', function (Request $request, Response $response) {

    $data = [
        "status" => "ok",
        "message" => "Slim API running"
    ];

    $response->getBody()->write(json_encode($data));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/market', function (Request $request, Response $response) {

    $data = [
        "symbol" => "BTCUSDT",
        "price" => 65000
    ];

    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/api/trade/list', function (Request $request, Response $response) {

    $data = [
        [
            "symbol" => "BTCUSDT",
            "side" => "BUY",
            "qty" => 0.01
        ]
    ];

    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();