<?php
include '../app/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Acme\Controller\FibonacciController;

$app = AppFactory::create();

$app->get('/check', function (Request $request, Response $response) {
    $response->getBody()->write('OK');
    return $response;
});

$app->get('/fibonacci/{number}', FibonacciController::class . ':FibonacciAction');

$app->run();
