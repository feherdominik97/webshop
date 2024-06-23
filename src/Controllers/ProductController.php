<?php

namespace App\Controllers;

use App\Controller;
use App\Helpers\Json;
use App\Models\Discount;
use App\Models\Product;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 *
 */
class ProductController extends Controller
{
    private $products;
    private $cart;
    public function __construct()
    {
        parent::__construct();

        $this->cart = Json::get('Cart')[0] ?? [];
        $this->products = Json::get('Product') ?? [];
        $discounts = Json::get('Discount') ?? [];

        foreach ($this->cart->getProducts() as $product) {
            foreach ($discounts as $discount) {
                $product->calculateNewPrice($discount);
            }
        }

        foreach ($this->products as $product) {
            foreach ($discounts as $discount) {
                $product->calculateNewPrice($discount);
            }
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
            'cart' => $this->cart
        ]);
    }
}