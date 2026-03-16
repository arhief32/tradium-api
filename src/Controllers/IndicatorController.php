<?php

namespace App\Controllers;

use App\Services\BinanceService;
use App\Services\IndicatorService;
use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndicatorController
{

    public function sma(Request $request, Response $response)
    {

        $symbol = $request->getQueryParams()['symbol'] ?? "BTCUSDT";
        $smaPeriod = $request->getQueryParams()['period'] ?? 14;

        $binance = new BinanceService();

        $klines = $binance->klines($symbol, "1m", 50);

        $closes = [];

        foreach ($klines as $k) {
            $closes[] = (float)$k[4];
        }

        $indicator = new IndicatorService();

        $sma = $indicator->sma($closes, $smaPeriod);

        return ResponseHelper::json($response, [
            "symbol" => $symbol,
            "sma" => $sma
        ]);
    }
}
