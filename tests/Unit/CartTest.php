<?php

namespace Unit;

use App\Models\Cart;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class CartTest extends TestCase
{
    private $products = [
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

    /**
     * @return void
     */
    public function testClassConstructor()
    {
        $cart = new Cart($this->products);
        
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product['newPrice'];
        }

        foreach ($this->products as $array_key => $product_array) {
            foreach ($product_array as $property => $value) {
                $this->assertSame($value, $cart->getProducts()[$array_key]->{'get' . ucfirst($property)}());
            }
        }

        $this->assertSame($sum, $cart->getSum());
    }

    /**
     * @return void
     */
    public function testAddProduct()
    {
        $cart = new Cart($this->products);

        $product_to_add = [
            'id' => 3005,
            'name' => 'a',
            'price' => 1000.0,
            'newPrice' => 500.0,
            'manufacturer' => 'ASUS'
        ];

        $cart->addProduct(new Product($product_to_add));

        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product['newPrice'];
        }
        $sum += $product_to_add['newPrice'];

        $this->assertSame($cart->getSum(), $sum);
    }

    /**
     * @return void
     */
    public function testRemoveProduct()
    {
        $cart = new Cart($this->products);

        $key_to_remove = 1;

        $cart->removeProduct($key_to_remove);

        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product['newPrice'];
        }
        $sum -= $this->products[$key_to_remove]['newPrice'];

        $this->assertSame($cart->getSum(), $sum);
    }

    public function testCalculateSum()
    {
        $cart = new Cart($this->products);

        $cart->calculateSum();

        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product['newPrice'];
        }

        $this->assertSame($cart->getSum(), $sum);
    }
}