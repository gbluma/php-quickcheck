<?php

class BasicTest extends \PHPUnit_Framework_TestCase
{
    public function test_single_int_parameter_closure()
    {
        $foo = function ($s) {
            $this->assertTrue(is_int($s));
        };
        QuickCheck\forall( $foo, 'int' );
    }

    public function test_single_string_parameter_closure()
    {
        $foo = function ($s) {
            $this->assertTrue(is_string($s));
        };
        QuickCheck\forall( $foo, 'string' );
    }

    public function test_two_int_parameter_closure()
    {
        $foo = function ($s, $t) {
            $this->assertTrue(is_int($s));
            $this->assertTrue(is_int($t));
        };
       QuickCheck\forall( $foo, 'int', 'int' );
    }
    
    public function standardFunction($s) 
    {
        $this->assertTrue(is_int($s));
    }
    
    public function test_single_int_parameter_standard()
    {
        QuickCheck\forall( array($this, "standardFunction"), 'int' );
        $this->assertTrue( true );
    }

}

