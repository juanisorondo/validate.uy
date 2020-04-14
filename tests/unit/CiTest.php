<?php

use Codeception\Test\Unit;
use juanisorondo\ValidadorUruguay\Ci;

class CiTest extends Unit
{
    public function testDotsHyphen()
    {
        $this->assertTrue(Ci::validate('1.212.121-2', Ci::DOTS_HYPHEN));
        $this->assertTrue(Ci::validate('738.753-8', Ci::DOTS_HYPHEN));
        $this->assertTrue(Ci::validate('0.738.753-8', Ci::DOTS_HYPHEN));

        $this->assertFalse(Ci::validate('1.212.121-1', Ci::DOTS_HYPHEN));
        $this->assertFalse(Ci::validate('12.121.212-2', Ci::DOTS_HYPHEN));
    }

    public function testHyphen()
    {
        $this->assertTrue(Ci::validate('1212121-2', Ci::HYPHEN));
        $this->assertTrue(Ci::validate('738753-8', Ci::HYPHEN));
        $this->assertTrue(Ci::validate('0738753-8', Ci::HYPHEN));

        $this->assertFalse(Ci::validate('1212121-1', Ci::HYPHEN));
        $this->assertFalse(Ci::validate('12121212-2', Ci::HYPHEN));
    }

    public function testNumbers()
    {
        $this->assertTrue(Ci::validate('12121212', Ci::NUMBERS));
        $this->assertTrue(Ci::validate('7387538', Ci::NUMBERS));
        $this->assertTrue(Ci::validate('07387538', Ci::NUMBERS));

        $this->assertFalse(Ci::validate('12121211', Ci::NUMBERS));
        $this->assertFalse(Ci::validate('121212122', Ci::NUMBERS));
    }

    public function testAllWithoutFormat()
    {
        $this->assertTrue(Ci::validate('1.212.121-2'));
        $this->assertFalse(Ci::validate('1.212.121-1'));

        $this->assertTrue(Ci::validate('0738753-8'));
        $this->assertFalse(Ci::validate('1212121-1'));

        $this->assertTrue(Ci::validate('07387538'));
        $this->assertFalse(Ci::validate('12121211'));
    }
}
