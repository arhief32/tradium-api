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

    function calculatePNL($trade, $current_price)
    {
        $entry_price = (float)$trade['entry_price'];
        $qty = (float)$trade['qty'];
        $side = $trade['side'];

        if ($side === 'LONG') {
            return (float)number_format(($current_price - $entry_price) * $qty, 2, '.', '');
        } else {
            return (float)number_format(($entry_price - $current_price) * $qty, 2, '.', '');
        }
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

        // get ticker
        $price = $this->binance->ticker($symbol)['price'];

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
        $trade_active = $this->repo->getLastActiveTrade();
        $pnl_active = $this->calculatePNL($trade_active, $price);
        $pnl_history = $this->repo->getTotalPNL();
        $pnl_total = $pnl_history + $pnl_active;
        $balance = $balance + $pnl_total;


        $result = [
            'balance' => $balance,
            'pnl_total' => $pnl_total,
            'pnl_history' => $pnl_history,
            'pnl_active' => $pnl_active,
            'bot_status' => $bot_status,
            'trade_active' => $trade_active,
            'price' => $price,
            'signal' => $signal,
            'sma5' => $sma5,
            'sma10' => $sma10,
        ];

        return $result;
    }
}
