<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Exception;

class AssertionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_assert_true()
    {
        $this->assertTrue(true);
//        $this->assertTrue(false);
//        Failed
    }
    public function test_assert_false()
    {
        $this->assertFalse(false);
//        $this->assertFalse(true); /* Failed */
    }
    public function test_assert_null()
    {
        $this->assertNull(null);
//        $this->assertNull(1); /* Failed */

    }
    public function test_assert_empty()
    {
        $empty = '';
        $this->assertEmpty($empty);
//        $this->assertEmpty(null); /* OK */
//        $this->assertEmpty(1); /* Failed */

    }
    public function test_assert_string()
    {
        $string = 'string';
        $non_string = 2;

        $this->assertIsString($string);
//        $this->assertIsString($non_string); /* Failed */
    }

    public function test_assert_int()
    {
        $int = 1;
        $non_int = "1";
        $this->assertIsInt($int);
//        $this->assertIsInt($non_int) /* Failed */
    }

    public function test_assert_equals()
    {
        $this->assertEquals(5,'5');
//        $this->assertEquals(5,'five'); /* Failed */
//        $this->assertEquals(5 , 4); /* Failed */
    }

    public function test_assert_same()
    {
        $a = 2 + 3;
        $b = 6 - 1;

        $this->assertSame($a,$b);

//        $this->assertSame(5,'5'); /* Failed */

    }

    public function test_assert_not_same()
    {
        $this->assertNotSame(5,'5');

//        $this->assertNotSame(5 , 5); /* Failed */
    }

    public function test_exception()
    {
        $this->expectException(Exception::class);

        throw new Exception(); /* Failed if wasn't */
    }

}
