<?php
// Placeholder API in case a backend is needed later.

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Factory\AppFactory;

require '../vendor/autoload.php';

// $app = new \Slim\App();
$app = AppFactory::create();

$app->setBasePath('/api');
$app->addRoutingMiddleware();

$app->get('/test', function (Request $request, Response $response, $args) {
    $response->getBody()->write('{"success":true}');
    return $response;
});

$app->run();

?>
