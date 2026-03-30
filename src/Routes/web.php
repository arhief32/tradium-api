<?php

use Slim\App;
use App\Services\WebPage\DashboardService;

return function (App $app) {
    $app->get('/', function ($request, $response) {
        $dashboardService = new DashboardService();
        $data = $dashboardService->dashboard(); 

        $result = [
            'title' => 'Dashboard',
            'content' => __DIR__ . '/../../frontend/pages/dashboard.php',
            'balance' => $data['balance'],
            'pnl' => $data['pnl'],
            'bot_status' => $data['bot_status'],
            'signal' => $data['signal'],
            'sma5' => $data['sma5'],
            'sma10' => $data['sma10'],
        ];

        extract($result);

        ob_start();
        include __DIR__ . '/../../frontend/layout/main.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    });

    $app->get('/market', function ($request, $response) {
        $data = [
            'title' => 'Market Data',
            'content' => __DIR__ . '/../../frontend/pages/dashboard.php',
        ];

        extract($data);

        ob_start();
        include __DIR__ . '/../../frontend/layout/main.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    });
};
