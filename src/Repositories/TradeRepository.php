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
            "exit_price" => $exit_price,
            "pnl" => $pnl,
            "status" => $status,
            "exit_fee" => $exit_fee,
            "exit_time" => $exit_time
        ]);

        return true;
    }

    public function getActiveTrades()
    {
        $db = DB::connect();
        $sql = "SELECT * FROM trades WHERE status = 'OPEN' ORDER BY entry_time DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLastActiveTradeBySymbol($symbol)
    {
        $db = DB::connect();
        $sql = "SELECT * FROM trades WHERE symbol = :symbol AND status = 'OPEN' ORDER BY entry_time DESC LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute(["symbol" => $symbol]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllHistoryTrades($limit, $offset)
    {
        $db = DB::connect();
        $stmt = $db->prepare("
            SELECT *
            FROM trades
            WHERE status = 'CLOSED'
            ORDER BY created_at DESC
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // create function for get total pnl
    public function getTotalPNL()
    {
        $db = DB::connect();
        $stmt = $db->query("SELECT SUM(pnl) as total FROM trades");
        return (float)$stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function countAllHistoryTrades()
    {        
        $db = DB::connect();
        $stmt = $db->query("SELECT COUNT(*) as total FROM trades WHERE status = 'CLOSED'");
        return (int)$stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }
}
