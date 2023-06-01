<?php

namespace App\Acme\Repository;

class FibonacciRepository
{
    private int $endNumber;

    public function __construct(int $number)
    {
        $this->endNumber = $number;
    }

    public function calculate(): string
    {
        $fibonacci = [0, 1];
        if ($this->endNumber <= 1) {
            return '1';
        } else {
            for ($i = 1; $i < $this->endNumber; $i++) {
                $fibonacci[] = $fibonacci[$i] + $fibonacci[$i - 1];
            }
        }

        return $this->changeResultFormat($fibonacci[$this->endNumber]);
    }

    private function changeResultFormat($result): string
    {
        return number_format($result, 0, '', '');
    }

}