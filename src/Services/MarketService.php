<?php

namespace App\Services;

class MarketService
{

    public function getMarket()
    {
        return [
            "symbol" => "BTCUSDT",
            "price" => 65000,
            "time" => date("Y-m-d H:i:s")
        ];
    }

    public function getSMA()
    {
        $prices = [64000, 64500, 65000, 64800, 65200];

        $sma = array_sum($prices) / count($prices);

        return [
            "prices" => $prices,
            "sma" => $sma
        ];
    }
}
