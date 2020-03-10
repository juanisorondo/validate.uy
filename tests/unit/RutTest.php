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
        $validator = new Rut();
        $this->assertInstanceOf(Rut::class, $validator);
        $this->assertEquals($result, $validator->validate($rut));
    }

    public function ejemplos()
    {
        return [
            ['210475730011', true],
            ['310475730011', false],
            ['2104757300110', false],
        ];
    }
}