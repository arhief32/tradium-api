<?php

use Slim\App;

use App\Controllers\MarketController;
use App\Controllers\IndicatorController;
use App\Controllers\TradeController;
use App\Controllers\SimulationController;

return function (App $app) {

    // create endpoint for health check
    $app->get('/api/health', function ($request, $response, $args) {
        $data = ['status' => 'ok'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->get('/api/market/ticker',[MarketController::class,'ticker']);
    $app->get('/api/market/klines',[MarketController::class,'klines']);

    $app->get('/api/indicator/sma',[IndicatorController::class,'sma']);

    $app->get('/api/trade/active',[TradeController::class,'active']);
    $app->get('/api/trade/history',[TradeController::class,'history']);
    $app->post('/api/trade',[TradeController::class,'create']);

    $app->get('/api/simulation/tradivarian',[SimulationController::class,'tradivarian']);

};