<?php

namespace App\Controllers;

use App\Helpers\Json;
use App\Models\Discount;
use App\Models\Product;

/**
 *
 */
class ProductController extends Controller
{
    private array $products = [];
    private array $discounts = [];
    public function __construct()
    {
        $products = Json::get('products');
        $discounts = Json::get('discounts');

        foreach ($discounts as $discount){
            $this->discounts[] = new Discount($discount);
        }

        foreach ($products as $product) {
            $product = new Product($product);
            foreach ($this->discounts as $discount) {
                $product->calculateNewPrice($discount);
            }

            $this->products[] = $product;
        }
    }
    public function index()
    {
        return $this->products;
    }
}