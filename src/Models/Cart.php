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
        foreach ($products as $product) {
            $product = new Product($product);
            $this->products[] = $product;
            $this->sum += $product->getNewPrice();
        }
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
     * @return int
     */
    public function getSum(): int
    {
        return $this->sum;
    }

    /**
     * @param int $sum
     */
    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}