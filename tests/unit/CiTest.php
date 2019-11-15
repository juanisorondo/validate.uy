<?php

use Codeception\Test\Unit;
use juanisorondo\ValidadorUruguay\Ci;

class CiCest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testDotsHyphen()
    {
        $validator = new Ci(Ci::DOTS_HYPHEN);
        $this->assertInstanceOf(Ci::class, $validator);

        $this->assertTrue($validator->validate('1.212.121-2'));
        $this->assertTrue($validator->validate('738.753-8'));
        $this->assertTrue($validator->validate('0.738.753-8'));

        $this->assertFalse($validator->validate('1.212.121-1'));
        $this->assertFalse($validator->validate('12.121.212-2'));
    }

    public function testHyphen()
    {
        $validator = new Ci(Ci::HYPHEN);
        $this->assertInstanceOf(Ci::class, $validator);

        $this->assertTrue($validator->validate('1212121-2'));
        $this->assertTrue($validator->validate('738753-8'));
        $this->assertTrue($validator->validate('0738753-8'));

        $this->assertFalse($validator->validate('1212121-1'));
        $this->assertFalse($validator->validate('12121212-2'));
    }

    public function testNumbers()
    {
        $validator = new Ci(Ci::NUMBERS);
        $this->assertInstanceOf(Ci::class, $validator);

        $this->assertTrue($validator->validate('12121212'));
        $this->assertTrue($validator->validate('7387538'));
        $this->assertTrue($validator->validate('07387538'));

        $this->assertFalse($validator->validate('12121211'));
        $this->assertFalse($validator->validate('121212122'));
    }
}