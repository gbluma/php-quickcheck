<?php

class BasicTest extends \PHPUnit_Framework_TestCase
{
    public function test_single_int_parameter_closure()
    {
        $foo = function ($s) {
            $this->assertTrue(is_int($s));
        };
        QuickCheck\forAll( $foo, 'int' );
    }

    public function test_single_string_parameter_closure()
    {
        $foo = function ($s) {
            $this->assertTrue(is_string($s));
        };
        QuickCheck\forAll( $foo, 'string' );
    }

    public function test_two_int_parameter_closure()
    {
        $foo = function ($s, $t) {
            $this->assertTrue(is_int($s));
            $this->assertTrue(is_int($t));
        };
       QuickCheck\forAll( $foo, 'int', 'int' );
    }
    
    public function standardFunction($s) 
    {
        $this->assertTrue(is_int($s));
    }
    
    public function test_single_int_parameter_standard()
    {
        QuickCheck\forAll( array($this, "standardFunction"), 'int' );
        $this->assertTrue( true );
    }

}

