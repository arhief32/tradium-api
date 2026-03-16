<?php

use Slim\App;
use App\Controllers\TradeController;
use App\Services\MarketService;
use App\Helpers\ResponseHelper;

return function (App $app) {

    $app->get('/', function ($request, $response) {

        return ResponseHelper::json($response, [
            "status" => "ok",
            "message" => "Slim API Running"
        ]);
    });

    $app->get('/api/market', function ($request, $response) {

        $service = new MarketService();

        return ResponseHelper::json(
            $response,
            $service->getMarket()
        );
    });

    $app->get('/api/sma', function ($request, $response) {

        $service = new MarketService();

        return ResponseHelper::json(
            $response,
            $service->getSMA()
        );
    });

    $app->get('/api/trade/list', [TradeController::class, 'list']);

    $app->post('/api/trade', [TradeController::class, 'create']);
};
