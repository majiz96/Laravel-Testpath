<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\OrderPriceService;

class OrderPriceServiceTest extends TestCase
{
    public function test_order_final_price_is_same()
    {
        $service = new OrderPriceService();

        $finalPrice = $service->calculate(1000,20);

        $this->assertSame(800,$finalPrice);
    }
}
