<?php


require '../vendor/autoload.php';
session_start();

use App\Helpers\Json;
use App\Helpers\Constants;

$_SESSION[Constants::$CART_KEY] = $_SESSION[Constants::$CART_KEY] ?? Json::get(Constants::$CART_KEY)[0];

$router = require '../src/Routes/index.php';