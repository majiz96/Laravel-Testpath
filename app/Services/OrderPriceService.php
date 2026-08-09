<?php

namespace App\Services;

class OrderPriceService
{
    public function calculate($price,$discount)
    {
        return $price - ($price * $discount / 100);
    }
}
