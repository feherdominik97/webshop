<?php

use App\Models\Condition;
use App\Models\Discount;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class ProductTest extends TestCase {
    /**
     * @return void
     */
    public function testClassConstructor()
    {
        $product_array = [
            'id' => 3002,
            'name' => 'a',
            'price' => 1000.0,
            'newPrice' => 1000.0,
            'manufacturer' => 'ASUS'
        ];

        $product_object = new Product($product_array);

        foreach ($product_array as $key => $product) {
            $this->assertSame($product, $product_object->{'get' . ucfirst($key)}());
        }
    }

    /**
     * @return void
     */
    public function testCalculateNewPrice()
    {
        $price = 2000;
        $percentage = 0.3;
        $value = 500;
        $discounts = [
            new Discount([
                'id' => 1,
                'is_percentage' => true,
                'value' => $percentage,
                'condition' => [
                    'property' => 'manufacturer',
                    'value' => 'ASUS'
                ]
            ]),
            new Discount([
                'id' => 2,
                'is_percentage' => false,
                'value' => $value,
                'condition' => [
                    'property' => 'id',
                    'value' => '3002'
                    ]
                ])
            ];

        $product = new Product([
            'id' => 3003,
            'name' => 'a',
            'price' => $price,
            'newPrice' => $price,
            'manufacturer' => 'ASUS'
        ]);

        $product->calculateNewPrice($discounts);

        $price = $product->getPrice();

        foreach ($discounts as $discount) {
            if($product->{'get' . ucfirst($discount->getCondition()->getProperty())}() === $discount->getCondition()->getValue()) {
                $price -= ($discount->isPercentage() ? $price : 1) * $discount->getValue();
            }
        }

        $this->assertSame($product->getNewPrice(), $price);
    }

}