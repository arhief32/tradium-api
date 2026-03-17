<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\SimulationService;

class SimulationController
{
    private $simulationService;

    public function tradivarian(Request $request, Response $response)
    {
        $this->simulationService = new SimulationService();

        $results = $this->simulationService->tradivarianSimulation();

        return ResponseHelper::json($response, [
            "message" => "Simulation completed",
            "results" => $results
        ]);
    }   
}
