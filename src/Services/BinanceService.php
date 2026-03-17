<?php

namespace App\Services;

use function DI\env;

class BinanceService
{

    private function request($endpoint)
    {
        $url = $_ENV['BINANCE_BASE_URL'] . $endpoint;

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function ticker($symbol = "BTCUSDT")
    {
        return $this->request("/fapi/v1/ticker/price?symbol=" . $symbol);
    }

    public function klines($symbol = "BTCUSDT", $interval = "1m", $limit = 50)
    {
        return $this->request(
            "/fapi/v1/klines?symbol={$symbol}&interval={$interval}&limit={$limit}"
        );
    }
}
