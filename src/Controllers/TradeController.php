<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TradeController
{

    public function active(Request $request, Response $response)
    {

        return ResponseHelper::json($response, [
            "activeTrades" => []
        ]);
    }

    public function history(Request $request, Response $response)
    {

        return ResponseHelper::json($response, [
            "history" => []
        ]);
    }

    public function create(Request $request, Response $response)
    {

        $body = $request->getParsedBody();

        return ResponseHelper::json($response, [
            "status" => "order created",
            "data" => $body
        ]);
    }
}
