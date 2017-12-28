<?php
// Placeholder API in case a backend is needed later.

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App();

$app->get('/test', function (Request $request, Response $response) {
    $response->getBody()->write('{"success":true}');
    return $response;
});

$app->run();

?>
