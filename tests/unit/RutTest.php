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
            ['020064100019', true],
            [217832560011, true],
            [213821960010,true],
        ];
    }
}