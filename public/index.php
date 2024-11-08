<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// ?²z???¨D
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use Slim\Http\Response as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/home.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath('');


// $app->group('/api', function () use ($app) {
//     $app->group('/older', function () use ($app) {
//         $app->get('_total',function (Request $request, Response $response, array $args) {
//                 $response->getBody()->write("Hello");
//                 return $response;
//             } );
//     });
// });

$app->get('/total',function (Request $request, Response $response, array $args) {
    $hc = new Home();

    $result = $hc->get_total($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/man/total',function (Request $request, Response $response, array $args) {
    $hc = new Home();

    $result = $hc->get_man_total($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/woman/total',function (Request $request, Response $response, array $args) {
    $hc = new Home();

    $result = $hc->get_woman_total($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/old/country/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_contry_old_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/old/area/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_area_old_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/young/country/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_country_young_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/young/area/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_area_young_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/infancy/area/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_infancy_area_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/infancy/country/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_infancy_country_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/contry/woman/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_contry_woman_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/area/woman/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_area_woman_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/contry/man/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_contry_man_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/area/man/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_area_man_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/contry/total/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_contry_total_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/area/total/Max_min',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_area_total_max_and_min($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/older/total',function (Request $request, Response $response, array $args) {
    $hc = new Home();

    $result = $hc->get_older_total($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/older/woman',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_older_woman($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/older/man',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_older_man($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/infancy/total',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_infancy_total($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/infancy/woman',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_infancy_woman($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/infancy/man',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_infancy_man($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/young/total',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_young_total($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/young/woman',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_young_woman($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );

$app->get('/young/man',function (Request $request, Response $response, array $args) {
    $hc = new Home();
    $result = $hc->get_young_man($request->getParsedBody());
    $response->getBody()->write((string)json_encode($result));
    $response = $response->withHeader('Content-type', 'application/json');
    return $response;
} );


$app->run();
