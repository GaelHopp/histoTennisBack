<?php
include ("./Player.php");
include ("./Match.php");
include ("./Set.php");
require '../vendor/autoload.php';

$app = new \Slim\Slim();



$app->get('/', function () {
    echo "<h1>Hello Slim World</h1>";
});

$app->get("/hello", function () {
    echo "Hello";
});

$app->get("/json", function () use ($app){
    $app->response->headers->set('Content-Type', 'application/json');

    $app->response->setBody(json_encode(getAllPlayers()));
});



/*

Routes for histoTennis

*/




$app->run();








?>