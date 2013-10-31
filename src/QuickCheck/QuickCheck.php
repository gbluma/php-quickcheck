<?php

namespace QuickCheck;

function gen_integer()
{
    return rand();
}

function gen_bool()
{
    return (gen_integer() % 2 == 0);
}

function gen_byte()
{
    return (gen_integer() % 256);
}

function gen_char()
{
    return chr( gen_integer() % 128 );
}

function gen_seq()
{
    $out = array();
    for ($i = 0; $i < 100; $i++) {
        $out[] = gen_integer() % 100;
    }
    return $out;
}

function gen_string()
{
    $str = '';
    foreach ( gen_seq() as $x ) {
        $str .= chr( $x );
    }
    return $str;
}

function gen_switcher($in)
{
    switch ( strtolower($in) )
    {
        case 'int':
        case 'integer':
            return gen_integer();
            break;

        case 'bool':
        case 'boolean':
            return gen_bool();
            break;

        case 'char':
        case 'character':
            return gen_char();
            break;

        case 'byte':
            return gen_byte();
            break;

        case 'seq':
        case 'sequence':
            return gen_seq();
            break;

        case 'string':
            return gen_string();
            break;

        default :
            throw new \Exception( "unable to parse quickcheck type." );
    }
}

function forall()
{
    $args = func_get_args();
    $func = array_shift($args);
    $nparam = count($args);
    $max_tests = 100 * $nparam;

    for ($i = 0; $i < $max_tests; $i++) {
        $params = array();
        for ($j = 0; $j < $nparam; $j++) {
            $params[] = gen_switcher( $args[$j] );
        }
        call_user_func_array($func, $params);
    }
}
