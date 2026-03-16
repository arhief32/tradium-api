<?php

namespace App\Controllers;

use App\Services\BinanceService;
use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MarketController
{

    public function ticker(Request $request, Response $response)
    {

        $symbol = $request->getQueryParams()['symbol'] ?? "BTCUSDT";

        $service = new BinanceService();

        $data = $service->ticker($symbol);

        return ResponseHelper::json($response, $data);
    }

    public function klines(Request $request, Response $response)
    {

        $query = $request->getQueryParams();

        $symbol = $query['symbol'] ?? "BTCUSDT";
        $interval = $query['interval'] ?? "1m";

        $service = new BinanceService();

        $data = $service->klines($symbol, $interval);

        return ResponseHelper::json($response, $data);
    }
}
