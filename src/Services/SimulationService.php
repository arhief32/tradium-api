<?php

namespace App\Services;

class SimulationService
{

    protected $trade, $strategy, $binance;

    public function __construct()
    {
        $this->trade = new TradeService();
        $this->strategy = new StrategyService();
        $this->binance = new BinanceService();
    }

    public function tradivarianSimulation()
    {
        $symbol = $_ENV['SYMBOL'] ?? "SOLUSDT";
        $amount = $_ENV['AMOUNT'] ?? 100;
        $limit = $_ENV['LIMIT'] ?? 100;
        $interval = $_ENV['INTERVAL'] ?? "1h";
    
        // get all active trades
        $activeTrades = $this->trade->checkActiveTrades();
        
        // get all active trades where symbol = $symbol
        $activeTrades = array_filter($activeTrades, function($trade) use ($symbol) {
            return $trade['symbol'] === $symbol;
        });

        // get klines for the symbol and interval
        $klines = $this->binance->klines($symbol, $interval, $limit);

        // extract closes from klines        
        $closes = array_map(function($kline) {
            return (float)$kline[4]; // close price is at index 4
        }, $klines);

        // get strategy signal
        $signal = $this->strategy->smaCrossover($closes);

        return [
            'activeTrades' => $activeTrades,
            'signal' => $signal,
        ];
    }
}