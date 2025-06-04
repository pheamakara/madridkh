<?php
define('BASE_PATH', dirname(__DIR__)); // Absolute base path for the project
require_once BASE_PATH . '/config/paths.php';
require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Database.php';

// Setup routes
$router = new Router();

// Home routes
$router->addRoute('/', 'HomeController', 'GET', 'index');

// News routes
$router->addRoute('/news', 'NewsController', 'GET', 'index');
$router->addRoute('/news/category/:id', 'NewsController', 'GET', 'category');
$router->addRoute('/news/:id', 'NewsController', 'GET', 'show');

// Match routes
$router->addRoute('/match', 'MatchController', 'GET', 'index');
$router->addRoute('/match/:id', 'MatchController', 'GET', 'show');

// Team routes
$router->addRoute('/team', 'TeamController', 'GET', 'index');
$router->addRoute('/player/:id', 'TeamController', 'GET', 'player');

// About route
$router->addRoute('/about', 'AboutController', 'GET', 'index');

// Contact routes
$router->addRoute('/contact', 'ContactController', 'GET', 'index');
$router->addRoute('/contact', 'ContactController', 'POST', 'store');

// Admin routes
$router->addRoute('/admin', 'AdminController', 'GET', 'dashboard');

// Dispatch the request
$requestUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->dispatch($requestUrl, $requestMethod);