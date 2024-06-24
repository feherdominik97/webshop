<?php
namespace App\Models;

use JsonSerializable;

class Cart implements JsonSerializable
{
    private $products = [];
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

            $this->sum = round($this->sum);
        }

    }

    public function addProduct($product)
    {
        $this->products[] = $product;
        $this->sum += $product->getNewPrice();
        $this->sum = round($this->sum);
    }

    public function removeProduct($key)
    {
        $this->sum -= $this->products[$key]->getNewPrice();
        array_splice($this->products, $key, 1);
        $this->sum = round($this->sum);
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

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}