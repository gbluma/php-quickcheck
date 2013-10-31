<?php

namespace QuickCheck;

function genInteger()
{
    return rand();
}

function genBool()
{
    return (genInteger() % 2 == 0);
}

function genByte()
{
    return (genInteger() % 256);
}

function genChar()
{
    return chr( genInteger() % 128 );
}

function genSeq()
{
    $out = array();
    for ($i = 0; $i < 100; $i++) {
        $out[] = genInteger() % 100;
    }
    return $out;
}

function genString()
{
    $str = '';
    foreach ( genSeq() as $x ) {
        $str .= chr( $x );
    }
    return $str;
}

function genSwitcher($in)
{
    switch ( strtolower( $in ) )
    {
        case 'int':
        case 'integer':
            return genInteger();
            break;
        
        case 'bool':
        case 'boolean':
            return genBool();
            break;
        
        case 'char':
        case 'character':
            return genChar();
            break;
        
        case 'byte':
            return genByte();
            break;
        
        case 'seq':
        case 'sequence':
            return genSeq();
            break;
        
        case 'string':
            return genString();
            break;
        
        default :
            throw new \Exception( "unable to parse quickcheck type." );
    }
}

function genData()
{
    $args = func_get_args();
    $nparam = count( $args );
    $max_tests = 100 * $nparam;
    
    $output = array();
    for ($i = 0; $i < $max_tests; $i++) {
        $params = array();
        for ($j = 0; $j < $nparam; $j++) {
            $params[] = genSwitcher( $args[$j] );
        }
        $output[] = $params;
    }
    return $output;
}

function forAll()
{
    $args = func_get_args();
    $func = array_shift( $args );
    $nparam = count( $args );
    $max_tests = 100 * $nparam;
    
    for ($i = 0; $i < $max_tests; $i++) {
        $params = array();
        for ($j = 0; $j < $nparam; $j++) {
            $params[] = genSwitcher( $args[$j] );
        }
        call_user_func_array( $func, $params );
    }
}
