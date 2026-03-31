<?php

namespace App\Services\WebPage;

use App\Repositories\TradeRepository;
use App\Services\BinanceService;
use App\Services\StrategyService;
use App\Services\IndicatorService;

class DashboardService
{
    private $repo, $binance, $indicator, $strategy;   

    // create constructor to initialize the repository
    public function __construct()
    {
        $this->repo = new TradeRepository();
        $this->binance = new BinanceService();
        $this->indicator = new IndicatorService();
        $this->strategy = new StrategyService();
    }
    
public function dashboard()
    {
        // env
        $balance = $_ENV['BALANCE'] ?? 0;
        $symbol = $_ENV['SYMBOL'] ?? "SOLUSDT";
        $amount = $_ENV['AMOUNT'] ?? 100;
        $limit = $_ENV['LIMIT'] ?? 100;
        $interval = $_ENV['INTERVAL'] ?? "1h";
        $bot_status = $_ENV['BOT_STATUS'] ?? "OFF";

        // get klines
        $klines = $this->binance->klines($symbol, $interval, $limit);
        
        // get closes
        $closes = [];
        foreach ($klines as $k) {
            $closes[] = (float)$k[4];
        }

        // get indicator 5 and 10
        $sma5 = $this->indicator->sma($closes, 5);
        $sma10 = $this->indicator->sma($closes, 10);
        
        // get signal
        $signal = $this->strategy->smaCrossover($closes);

        // get balance
        $pnl_total = $this->repo->getTotalPnl()['total_closed'] ?? 0;
        $pnl_active = $this->repo->getTotalPnl()['total_open'] ?? 0;
        $balance = $balance + $pnl_total;
        

        $result = [
            'balance' => $balance,
            'pnl_total' => $pnl_total,
            'pnl_active' => $pnl_active,
            'bot_status' => $bot_status,
            'signal' => $signal,
            'sma5' => $sma5,
            'sma10' => $sma10,
        ];

        return $result;
    }
}
