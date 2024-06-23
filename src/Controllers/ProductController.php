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
    private $discounts;
    public function __construct()
    {
        parent::__construct();

        $this->products = Json::get('Product') ?? [];
        $this->discounts = Json::get('Discount') ?? [];

        foreach ($this->products as $product) {
            foreach ($this->discounts as $discount) {
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
        $this->render('index', ['products' => $this->products]);
    }
}