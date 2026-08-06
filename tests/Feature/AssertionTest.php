<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssertionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_assert_true()
    {
        $this->assertTrue(true);
//        $this->assertTrue(false); => Failure
    }

}
