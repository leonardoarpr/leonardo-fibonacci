<?php

namespace AppTest\Acme\Repository;

use App\Acme\Repository\FibonacciRepository as Repository;
use PHPUnit\Framework\TestCase;

class FibonacciRepository extends TestCase
{
    public function testCalculate()
    {
        $result = new Repository(50);
        $this->assertEquals($result->calculate(), '12586269025');
    }
}
