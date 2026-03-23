<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\TradeService;

class TradeController
{
    private $tradeService;

    // create constructor to initialize the service
    public function __construct()
    {
        $this->tradeService = new TradeService();
    }

    public function active(Request $request, Response $response)
    {
        $activeTrades = $this->tradeService->checkActiveTrades();

        return ResponseHelper::json($response, [
            "activeTrades" => $activeTrades
        ]);
    }

    public function history(Request $request, Response $response)
    {
        $params = $request->getQueryParams();

        $page = isset($params['page']) ? (int)$params['page'] : 1;
        $limit = isset($params['limit']) ? (int)$params['limit'] : 10;

        $result = $this->tradeService->getHistoryTrades($page, $limit);

        $payload = [
            'status' => 'success',
            'data' => $result['data'],
            'meta' => $result['meta']
        ];

        return ResponseHelper::json($response, $payload);
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
