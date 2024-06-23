<?php
namespace App;

use App\Controllers\CartController;
use App\Controllers\ProductController;

$router = new Router();

$router->get('/', ProductController::class, 'index');
$router->get('/cart', CartController::class, 'index');
$router->post('/cart', CartController::class, 'getCart');

$router->dispatch();