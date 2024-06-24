<?php

namespace App\Controllers;

use App\Controller;
use App\Helpers\Json;
use App\Helpers\Constants;
use App\Models\Cart;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 *
 */
class ProductController extends Controller
{
    /**
     * @var array|mixed
     */
    private $products;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $_SESSION[Constants::$CART_KEY] = $_SESSION[Constants::$CART_KEY] ?? (Json::get(Constants::$CART_KEY)[0] ?? new Cart([]));
        $this->products = Json::get(Constants::$PRODUCT_KEY) ?? [];
        $discounts = Json::get(Constants::$DISCOUNT_KEY) ?? [];

        foreach ($_SESSION[Constants::$CART_KEY]->getProducts() as $product) {
            $product->calculateNewPrice($discounts);
        }

        foreach ($this->products as $product) {
            $product->calculateNewPrice($discounts);
        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $this->render('index', [
            'products' => $this->products,
            'cart' => $_SESSION[Constants::$CART_KEY]
        ]);
    }
}