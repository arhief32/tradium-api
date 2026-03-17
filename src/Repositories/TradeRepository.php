<?php

namespace App\Repositories;

use App\Database\DB;

class TradeRepository
{

    public function create($data)
    {

        $db = DB::connect();
        $sql = "INSERT INTO trades (symbol, side, qty, entry_time, entry_price, status, entry_fee)
                VALUES (:symbol, :side, :qty, NOW(), :price, 'OPEN', :entry_fee)";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            "symbol" => $data['symbol'],
            "side" => $data['side'],
            "price" => $data['price'],
            "qty" => $data['qty'],
            "entry_fee" => $data['entry_fee']
        ]);

        return $db->lastInsertId();
    }

    public function update($tradeId, $data)
    {
        $exit_price = $data['exit_price'] ?? null;
        $exit_time = $data['exit_time'] ?? null;
        $pnl = $data['pnl'] ?? null;
        $exit_fee = $data['exit_fee'] ?? null;
        $status = $data['status'] ?? null;

        $db = DB::connect();
        $sql = "UPDATE trades SET exit_time = :exit_time, exit_price = :exit_price, pnl = :pnl, status = :status, exit_fee = :exit_fee WHERE id = :id";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            "id" => $tradeId,
            "exit_price" => $data['exit_price'],
            "pnl" => $data['pnl'],
            "status" => $data['status'],
            "exit_fee" => $data['exit_fee'],
            "exit_time" => $data['exit_time']
        ]);

        return true;
    }
}
