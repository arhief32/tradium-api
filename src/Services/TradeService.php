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

    function updatePrice()
    {
        
    }
}