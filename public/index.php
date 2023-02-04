<?php

require_once __DIR__ . '/../vendor/autoload.php';

use WebApp\PHP\MVC\App\Router;
use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Controller\HomeController;
use WebApp\PHP\MVC\Controller\ProductController;
use WebApp\PHP\MVC\Controller\PurchaseController;
use WebApp\PHP\MVC\Controller\SaleController;
use WebApp\PHP\MVC\Controller\UserController;
use WebApp\PHP\MVC\Middleware\MustNotLoginMiddleware;
use WebApp\PHP\MVC\Middleware\MustLoginMiddleware;

Database::getConnection('prod');

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

// User Controller
Router::add('POST', '/users/login', UserController::class, 'postLogin', [
  MustNotLoginMiddleware::class,
]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [
  MustLoginMiddleware::class,
]);
Router::add('GET', '/users', UserController::class, 'usersList', [
  MustLoginMiddleware::class,
]);
// Products Controller
Router::add('GET', '/product', ProductController::class, 'index', [
  MustLoginMiddleware::class,
]);

// Sale Controller
Router::add('GET', '/sale', SaleController::class, 'index', [
  MustLoginMiddleware::class,
]);

// Purchase Controller
Router::add('GET', '/purchase', PurchaseController::class, 'index', [
  MustLoginMiddleware::class,
]);

Router::run();