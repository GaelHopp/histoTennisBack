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


//Players

$app->get("/players", function () use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getAllPlayers()));
});

$app->get("/players/:id", function ($id) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getPlayerById($id)));
});

$app->get("/players/lastName/:lastName", function ($lastName) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getPlayerByLastName($lastName)));
});

$app->get("/players/firstName/:firstName", function ($firstName) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getPlayerByFirstName($firstName)));
});


//Match

$app->get("/matches", function () use ($app){
    $matches = getAllMatches();


    foreach ($matches as $idMatchArray => $arrayDetails) {
    	
    	$idMatch = $arrayDetails['idMatch'];
    	$sets = getAllSetsByIdMatch($idMatch);
    	$matches[$idMatchArray]['sets'] = $sets;
  	  }
    
    	
	
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});

$app->get("/matches/:id", function ($id) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchById($id)));
});

$app->get("/matches/won/:id", function ($id) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchWonByIdPlayer($id)));
});

$app->get("/matches/loss/:id", function ($id) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchWonByIdPlayer($id)));
});

$app->get("/matches/date/:date", function ($date) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchByDate($date)));
});

$app->get("/matches/before/:date", function ($date) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchBeforeDate($date)));
});

$app->get("/matches/after/:date", function ($date) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchAfterDate($date)));
});

$app->get("/matches/between/:dateBefore/:dateAfter", function ($dateBefore, $dateAfter) use ($app){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode(getMatchBetweenDates($dateBefore, $dateAfter)));
});





$app->run();








?>