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
            'pnl_total' => (float)number_format($data['pnl_total'], 2, '.', ','),
            'pnl_history' => (float)number_format($data['pnl_history'], 2, '.', ','),
            'pnl_active' => (float)number_format($data['pnl_active'], 2, '.', ','),
            'bot_status' => $data['bot_status'],
            'trade_active' => $data['trade_active'],
            'price' => $data['price'],
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
