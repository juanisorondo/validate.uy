<?php

use Codeception\Test\Unit;
use juanisorondo\ValidadorUruguay\Rut;

class RutTest extends Unit
{
    /**
     * @dataProvider ejemplos
     */
    public function testRuts($rut, $result)
    {
        $this->assertEquals($result, Rut::validate($rut));
    }

    public function ejemplos()
    {
        return [
            ['210475730011', true],
            ['310475730011', false],
            ['2104757300110', false],
            ['20064100019', true],// 11 digitos
            [217832560011, true],
        ];
    }
}