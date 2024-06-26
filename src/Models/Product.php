<?php

namespace App\Models;

use JsonSerializable;

/**
 *
 */
class Product implements JsonSerializable
{
    /**
     * @var int|mixed
     */
    private $id;
    /**
     * @var mixed|string
     */
    private $name;
    /**
     * @var int|mixed
     */
    private $price;
    /**
     * @var int|mixed
     */
    private $newPrice;
    /**
     * @var mixed|string
     */
    private $manufacturer;

    /**
     * @param $product
     */
    public function __construct($product)
    {
        $this->id = $product['id'] ?? 0;
        $this->name = $product['name'] ?? '';
        $this->price = $product['price'] ?? 0;
        $this->newPrice = $product['newPrice'] ?? ($product['price'] ?? 0);
        $this->manufacturer = $product['manufacturer'] ?? '';
    }

    /**
     * @param array $discounts
     * @return void
     */
    public function calculateNewPrice(array $discounts)
    {
        $price = $this->price;//1000
        foreach ($discounts as $discount) {
            if($this->{$discount->getCondition()->getProperty()} === $discount->getCondition()->getValue()) {
                //if it is a percentage discount the price needs to be multiplied by
                // the discount and subtract the result from the original price, otherwise
                // we just need to subtract the discount from the original price.
                $price -= ($discount->isPercentage() ? $price : 1) * $discount->getValue();
            }
        }

        $this->newPrice = $price;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getNewPrice(): float
    {
        return $this->newPrice;
    }

    /**
     * @param float $newPrice
     */
    public function setNewPrice(int $newPrice): void
    {
        $this->newPrice = $newPrice;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}