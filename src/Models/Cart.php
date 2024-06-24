<?php
namespace App\Models;

use JsonSerializable;

/**
 *
 */
class Cart implements JsonSerializable
{
    /**
     * @var array
     */
    private $products = [];
    /**
     * @var float|int
     */
    private $sum = 0;

    /**
     * @param $products
     */
    public function __construct($products)
    {
        if(is_array($products) || is_object($products)){
            foreach ($products as $product) {
                $product = new Product($product);
                $this->products[] = $product;
                $this->sum += $product->getNewPrice();
            }
        }

    }

    /**
     * @param $product
     * @return void
     */
    public function addProduct($product)
    {
        $this->products[] = $product;
        $this->calculateSum();
    }

    /**
     * @param $key
     * @return void
     */
    public function removeProduct($key)
    {
        array_splice($this->products, $key, 1);
        $this->calculateSum();
    }

    /**
     * @return void
     */
    public function calculateSum()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getNewPrice();
        }

        $this->sum = $sum;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     */
    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}