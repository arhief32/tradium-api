<?php

use Slim\App;

return function (App $app) {
    $app->get('/', function ($request, $response) {
        $data = [
            'title' => 'Dashboard',
            'content' => __DIR__ . '/../../frontend/pages/dashboard.php',
        ];

        extract($data);

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
