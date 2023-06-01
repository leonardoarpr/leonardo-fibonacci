<?php

namespace AppTest\Acme\Repository;

use App\Acme\Repository\FibonacciRepository;
use PHPUnit\Framework\TestCase;

class FibonacciTest extends TestCase
{
    public function testCalculate()
    {
        $result = new FibonacciRepository(50);
        $this->assertEquals($result->calculate(), '12586269025');
    }
}
