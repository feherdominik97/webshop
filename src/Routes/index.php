<?php
namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProductController;

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/products', ProductController::class, 'index');

$router->dispatch();