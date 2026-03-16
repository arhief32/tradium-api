<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TradeController
{

    public function list(Request $request, Response $response)
    {

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

        return ResponseHelper::json($response, $trades);
    }

    public function create(Request $request, Response $response)
    {

        $body = $request->getParsedBody();

        return ResponseHelper::json($response, [
            "status" => "trade created",
            "data" => $body
        ]);
    }
}
