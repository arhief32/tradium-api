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
    
        // 1. ambil market
        $klines = $this->binance->klines($symbol, $interval, $limit);

        $closes = [];
        foreach ($klines as $k) {
            $closes[] = (float)$k[4];
        }

        // 2. ambil signal
        $signal = $this->strategy->smaCrossover($closes);

        // 3. ambil harga sekarang
        $ticker = $this->binance->ticker($symbol);
        $price = (float)$ticker['price'];

        // 4. cek trade aktif
        $activeTrade = $this->trade->checkLastActiveTradeBySymbol($symbol);

        // 5. mendapatkan presisi harga
        $pricePrecision = $this->binance->pricePrecision($symbol);

        // =========================
        // 🚫 TIDAK ADA TRADE
        // =========================
        if (!$activeTrade) {

            if ($signal == "BUY") {
                return $this->trade->create($symbol, "LONG", $amount); // 100 USDT
            }

            if ($signal == "SELL") {
                return $this->trade->create($symbol, "SHORT", $amount);
            }

            return [
                "message" => "No trade & no signal"
            ];
        }

        // =========================
        // ✅ ADA TRADE
        // =========================

        $pnl = $this->calculatePNL($activeTrade, $price);

        // CLOSE jika berlawanan
        if (
            ($activeTrade['side'] == "LONG" && $signal == "SELL") ||
            ($activeTrade['side'] == "SHORT" && $signal == "BUY")
        ) {

            $this->trade->update($activeTrade['id'], [
                'exit_price' => $price,
                'exit_time' => date('Y-m-d H:i:s'),
                'exit_fee' => $activeTrade['amount'] * 0.0004, // 0.04% fee (taker)
                'pnl' => $pnl,
                'status' => 'CLOSED',
                ]);

            return [
                "message" => "Trade closed",
                "symbol" => $symbol,
                "side" => $activeTrade['side'],
                "entry_price" => (float)number_format($activeTrade['entry_price'], $pricePrecision, '.', ''),
                "exit_price" => (float)number_format($price, $pricePrecision, '.', ''),
                "pnl" => (float)number_format($pnl, $pricePrecision, '.', '')
            ];
        }

        // HOLD
        return [
            "message" => "Trade still open",
            "symbol" => $symbol,
            "side" => $activeTrade['side'],
            "entry_price" => (float)number_format($activeTrade['entry_price'], $pricePrecision, '.', ''),
            "current_price" => (float)number_format($price, $pricePrecision, '.', ''),
            "pnl" => (float)number_format($pnl, $pricePrecision, '.', ''),
        ];
    }

    private function calculatePNL($trade, $current_price)
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
}