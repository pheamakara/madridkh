<?php
$uri = $_SERVER['REQUEST_URI'];
switch (parse_url($uri, PHP_URL_PATH)) {
    case '/':
        require_once __DIR__ . '/controllers/HomeController.php';
        (new HomeController())->index();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
}
