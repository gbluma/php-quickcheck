<?php

class DataProviderTest extends \PHPUnit_Framework_TestCase
{
    public function getData()
    {
        return QuickCheck\gen_data( 'int', 'int' );
    }

    /**
     * @dataProvider getData
     */
    public function test_data_provider($x, $y)
    {
        $this->assertTrue( is_int( $x ) );
        $this->assertTrue( is_int( $y ) );
    }
}