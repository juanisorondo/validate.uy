<?php

namespace tests;

use juanisorondo\ValidadorUruguay\Rut;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RutTest extends TestCase
{
    #[DataProvider('ejemplos')]
    public function testRuts($rut, $result)
    {
        $this->assertEquals($result, Rut::validate($rut));
    }

    public static function ejemplos()
    {
        return [
            ['210475730011', true],
            ['310475730011', false],
            ['2104757300110', false],
            ['020064100019', true],
            [217832560011, true],
            [213821960010, true],
            [000000000000, false],
            [123456789125, false],
            [698758785878, false],
            [210407620010, false], //digito verificador es 10
        ];
    }
}
