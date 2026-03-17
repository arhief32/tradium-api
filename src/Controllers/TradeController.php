<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\TradeService;

class TradeController
{
    private $tradeService;

    public function active(Request $request, Response $response)
    {
        $this->tradeService = new TradeService();
        $activeTrades = $this->tradeService->checkActiveTrades();

        return ResponseHelper::json($response, [
            "activeTrades" => $activeTrades
        ]);
    }

    public function history(Request $request, Response $response)
    {

        return ResponseHelper::json($response, [
            "history" => []
        ]);
    }

    public function create(Request $request, Response $response)
    {

        $body = $request->getParsedBody();

        $symbol = $body['symbol'] ?? null;
        $side = $body['side'] ?? null;
        $amount = $body['amount'] ?? null;

        if (!$symbol || !$side || !$amount) {

            return ResponseHelper::json($response, [
                "error" => "symbol, side, and amount required"
            ], 400);
        }

        $tradeService = new TradeService();
        $tradeData = $tradeService->create($symbol, $side, $amount);

        return ResponseHelper::json($response, [
            "message" => "Trade created",
            "data" => $tradeData
        ]);
    }
}
