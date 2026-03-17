<?php

namespace App\Services;

use App\Repositories\TradeRepository;

class TradeService
{

    function create($symbol, $side, $amount)
    {
        $binance = new BinanceService();

        $ticker = $binance->ticker($symbol);
        $price = (float)$ticker['price'];
        $qty = $amount / $price;
        $entry_fee = $amount * 0.0004; // 0.04% fee (taker)

        $trade = [
            "symbol" => $symbol,
            "side" => $side,
            "price" => $price,
            "qty" => $qty,
            "amount" => $amount,
            "entry_fee" => $entry_fee
        ];

        $repo = new TradeRepository();

        $id = $repo->create($trade);

        return [
            "trade_id" => $id,
            "symbol" => $symbol,
            "price" => $price,
            "qty" => (float)number_format($qty, 8, '.', ''),
            "amount" => (float)number_format($amount, 8, '.', ''),
            "entry_fee" => (float)number_format($entry_fee, 8, '.', '')
        ];
    }

    function checkActiveTrades()
    {
        // get all active trades
        $repo = new TradeRepository();
        $activeTrades = $repo->getActiveTrades();
        $binance = new BinanceService();
        for ($i = 0; $i < count($activeTrades); $i++) {
            $trade = $activeTrades[$i];
            $ticker = $binance->ticker($trade['symbol']);
            $current_price = (float)$ticker['price'];
            $entry_price = (float)$trade['entry_price'];
            $side = $trade['side'];
            $pnl = 0;

            if ($side === 'LONG') {
                $pnl = ($current_price - $entry_price) * $trade['qty'];
            } else {
                $pnl = ($entry_price - $current_price) * $trade['qty'];
            }

            // Here you can implement logic to close the trade based on certain conditions
            // For example, if pnl > 10% or pnl < -5%, etc.

            // just return all active trades now with pnl
            $activeTrades[$i]['qty'] = (float)number_format($trade['qty'], 2, '.', '');
            $activeTrades[$i]['entry_price'] = (float)number_format($entry_price, 2, '.', '');
            $activeTrades[$i]['current_price'] = (float)number_format($current_price, 2, '.', '');
            $activeTrades[$i]['entry_fee'] = (float)number_format($trade['entry_fee'], 2, '.', '');
            $activeTrades[$i]['pnl'] = (float)number_format($pnl, 2, '.', '');
        }

        return $activeTrades;
    }
}
