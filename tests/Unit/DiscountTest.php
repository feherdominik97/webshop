<?php

namespace Unit;

use App\Models\Discount;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class DiscountTest extends TestCase
{
    /**
     * @return void
     */
    public function testClassConstructor()
    {
        $discount_array = [
            'id' => 3002,
            'is_percentage' => false,
            'value' => 1000,
            'condition' => [
                'property' => 'id',
                'value' => 1,
            ]
        ];

        $discount_object = new Discount($discount_array);

        $this->assertSame($discount_array['id'], $discount_object->getId());
        $this->assertSame((float) $discount_array['value'], $discount_object->getValue());
        $this->assertSame($discount_array['is_percentage'], $discount_object->isPercentage());

        $this->assertSame($discount_array['condition']['value'], $discount_object->getCondition()->getValue());
        $this->assertSame($discount_array['condition']['property'], $discount_object->getCondition()->getProperty());
    }

}