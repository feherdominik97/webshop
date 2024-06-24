<?php

namespace App\Models;

/**
 *
 */
class Discount
{
    /**
     * @var mixed
     */
    private $id;
    /**
     * @var mixed
     */
    private $percentage;
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var Condition
     */
    private $condition;

    /**
     * @param $discount
     */
    public function __construct($discount)
    {
        $this->id = $discount['id'];
        $this->percentage = $discount['is_percentage'];
        $this->value = $discount['value'];
        $this->condition = new Condition($discount['condition']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isPercentage(): bool
    {
        return $this->percentage;
    }

    /**
     * @param bool $percentage
     */
    public function setPercentage(bool $percentage): void
    {
        $this->percentage = $percentage;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return Condition
     */
    public function getCondition(): Condition
    {
        return $this->condition;
    }

    /**
     * @param Condition $condition
     */
    public function setCondition(Condition $condition): void
    {
        $this->condition = $condition;
    }
}