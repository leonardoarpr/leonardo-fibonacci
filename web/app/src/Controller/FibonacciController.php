<?php

namespace App\Acme\Controller;

use App\Acme\Repository\FibonacciRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FibonacciController
{
    public static function FibonacciAction(Request $request, Response $response, $args): Response
    {
        $number = (int)$args['number'];
        $fibonacci = new FibonacciRepository($number);

        $response->getBody()->write(
            json_encode(['result' => $fibonacci->calculate()])
        );

        return $response;
    }
}
