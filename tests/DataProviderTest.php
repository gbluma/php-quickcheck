<?php

class DataProviderTest extends \PHPUnit_Framework_TestCase
{
    public function genIntInt()
    {
        return QuickCheck\genData( 'int', 'int' );
    }

    /**
     * @dataProvider genIntInt
     */
    public function test_data_provider($x, $y)
    {
        $this->assertTrue( is_int( $x ) );
        $this->assertTrue( is_int( $y ) );
    }
}