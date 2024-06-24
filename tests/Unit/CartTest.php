<?php

namespace Unit;

use App\Models\Cart;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testClassConstructor()
    {
        $products = [
            [
                'id' => 3002,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 1000.0,
                'manufacturer' => 'ASUS'
            ],
            [
                'id' => 3003,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 1000.0,
                'manufacturer' => 'ASUS'
            ],
            [
                'id' => 3004,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 500.0,
                'manufacturer' => 'ASUS'
            ]
        ];

        $cart = new Cart($products);

        $sum = 0;
        foreach ($products as $product) {
            $sum += $product['newPrice'];
        }

        foreach ($products as $array_key => $product_array) {
            foreach ($product_array as $property => $value) {
                $this->assertSame($value, $cart->getProducts()[$array_key]->{'get' . ucfirst($property)}());
            }
        }

        $sum = round($sum);

        $this->assertSame($sum, $cart->getSum());
    }

    public function testAddProduct()
    {
        $products = [
            [
                'id' => 3002,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 1000.0,
                'manufacturer' => 'ASUS'
            ],
            [
                'id' => 3003,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 1000.0,
                'manufacturer' => 'ASUS'
            ],
            [
                'id' => 3004,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 500.0,
                'manufacturer' => 'ASUS'
            ]
        ];

        $cart = new Cart($products);

        $product_to_add = [
            'id' => 3005,
            'name' => 'a',
            'price' => 1000.0,
            'newPrice' => 500.0,
            'manufacturer' => 'ASUS'
        ];

        $cart->addProduct(new Product($product_to_add));

        $sum = 0;
        foreach ($products as $product) {
            $sum += $product['newPrice'];
        }
        $sum = round($sum);
        $sum += $product_to_add['newPrice'];
        $sum = round($sum);

        $this->assertSame($cart->getSum(), $sum);
    }

    public function testRemoveProduct()
    {
        $products = [
            [
                'id' => 3002,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 1000.0,
                'manufacturer' => 'ASUS'
            ],
            [
                'id' => 3003,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 1000.0,
                'manufacturer' => 'ASUS'
            ],
            [
                'id' => 3004,
                'name' => 'a',
                'price' => 1000.0,
                'newPrice' => 500.0,
                'manufacturer' => 'ASUS'
            ]
        ];

        $cart = new Cart($products);

        $key_to_remove = 1;

        $cart->removeProduct($key_to_remove);

        $sum = 0;
        foreach ($products as $product) {
            $sum += $product['newPrice'];
        }
        $sum = round($sum);
        $sum -= $products[$key_to_remove]['newPrice'];
        $sum = round($sum);

        $this->assertSame($cart->getSum(), $sum);
    }
}