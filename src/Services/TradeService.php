<?php

namespace App\Services;

use App\Repositories\TradeRepository;

class TradeService
{
    private $repo, $binance;
    // create constructor to initialize the repository
    public function __construct()
    {
        $this->repo = new TradeRepository();
        $this->binance = new BinanceService();
    }

    function create($symbol, $side, $amount)
    {
        $ticker = $this->binance->ticker($symbol);
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

        $id = $this->repo->create($trade);

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
        $activeTrades = $this->repo->getActiveTrades();
        for ($i = 0; $i < count($activeTrades); $i++) {
            $trade = $activeTrades[$i];
            $ticker = $this->binance->ticker($trade['symbol']);
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

    function checkLastActiveTradeBySymbol($symbol)
    {
        return $this->repo->getLastActiveTradeBySymbol($symbol);
    }

    function update($tradeId, $data)
    {
        return $this->repo->update($tradeId, $data);
    }

    function getHistoryTrades($page = 1, $limit = 1)
    {
        if ($page < 1) $page = 1;
        if ($limit < 1 || $limit > 100) $limit = 10;

        $offset = ($page - 1) * $limit;

        $data = $this->repo->getAllHistoryTrades($limit, $offset);
        $total = $this->repo->countAllHistoryTrades();

        // menyesuaikan format data untuk response
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['qty'] = (float)number_format($data[$i]['qty'], 2, '.', '');
            $data[$i]['entry_price'] = (float)number_format($data[$i]['entry_price'], 2, '.', '');
            $data[$i]['exit_price'] = (float)number_format($data[$i]['exit_price'] ?? 0, 2, '.', '');
            $data[$i]['entry_fee'] = (float)number_format($data[$i]['entry_fee'], 2, '.', '');
            $data[$i]['exit_fee'] = (float)number_format($data[$i]['exit_fee'] ?? 0, 2, '.', '');
            $data[$i]['pnl'] = (float)number_format($data[$i]['pnl'] ?? 0, 2, '.', '');
        }

        return [
            'data' => $data,
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'total_page' => ceil($total / $limit)
            ]
        ];
    }
}
