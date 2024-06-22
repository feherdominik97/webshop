<?php

namespace App\Controllers;

use App\Controller;
use App\Helpers\Json;
use App\Models\Discount;
use App\Models\Product;

/**
 *
 */
class ProductController extends Controller
{
    private array $products;
    private array $discounts;
    public function __construct()
    {
        $this->products = Json::get('Product') ?? [];
        $this->discounts = Json::get('Discount') ?? [];

        foreach ($this->products as $product) {
            foreach ($this->discounts as $discount) {
                $product->calculateNewPrice($discount);
            }
        }
    }
    public function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->products);
    }
}