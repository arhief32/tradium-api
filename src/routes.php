<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function ($app) {

    /* health check */
    $app->get('/', function (Request $request, Response $response) {

        return json($response, [
            "status" => "ok",
            "message" => "Slim API running"
        ]);
    });

    /* contoh market */
    $app->get('/api/market', function (Request $request, Response $response) {

        $data = [
            "symbol" => "BTCUSDT",
            "price" => 65000,
            "time" => date("Y-m-d H:i:s")
        ];

        return json($response, $data);
    });

    /* contoh hitung SMA */
    $app->get('/api/sma', function (Request $request, Response $response) {

        $prices = [64000, 64500, 65000, 64800, 65200];

        $sma = array_sum($prices) / count($prices);

        return json($response, [
            "prices" => $prices,
            "sma" => $sma
        ]);
    });

    /* list trade */
    $app->get('/api/trade/list', function (Request $request, Response $response) {

        $trades = [
            [
                "symbol" => "BTCUSDT",
                "side" => "BUY",
                "qty" => 0.01
            ],
            [
                "symbol" => "ETHUSDT",
                "side" => "SELL",
                "qty" => 0.5
            ]
        ];

        return json($response, $trades);
    });

    /* create trade */
    $app->post('/api/trade', function (Request $request, Response $response) {

        $body = $request->getParsedBody();

        return json($response, [
            "status" => "trade created",
            "data" => $body
        ]);
    });

};