<?php

use Codeception\Test\Unit;
use juanisorondo\ValidadorUruguay\Ci;
use juanisorondo\ValidadorUruguay\Rut;

class RutTest extends Unit
{
    public function testRuts()
    {
        $validator = new Rut();
        $this->assertInstanceOf(Rut::class, $validator);

        $this->assertTrue($validator->validate('210475730011'));
        $this->assertFalse($validator->validate('310475730011'));
    }
}