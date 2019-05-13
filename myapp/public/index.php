<?php
/* Autor Nedra ABIDI 12/05/2019 : 16:30h */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';
require '../src/models/Item.php';
require '../src/models/Liste.php';

// For debugging
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$container = $app -> getContainer();

// Register component on container
$container['view'] = function($container) {
	return new \Slim\Views\PhpRenderer('./templates/');
};
// Front end application 
$app -> get('/', function($request, $response, $args) use ($app) {
    
    return $this->view->render($response, 'index.html');
}) -> setName('index');

// Back end - API application 
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


// List Routes
require '../src/api/List/get.php';
require '../src/api/List/delete.php';
require '../src/api/List/post.php';

// Item Routes
require '../src/api/Item/get.php';
require '../src/api/Item/delete.php';
require '../src/api/Item/post.php';


$app->run();