<?php

namespace App\Models;

/**
 *
 */
class Condition
{
    /**
     * @var mixed
     */
    private $property;
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param $condition
     */
    public function __construct($condition)
    {
        $this->property = $condition['property'];
        $this->value = $condition['value'];
    }

    /**
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty(string $property): void
    {
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

}