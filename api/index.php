<?php
include ("./Base.php");
require '../vendor/autoload.php';

$app = new \Slim\Slim();



$app->get('/', function () {
    echo "<h1>Hello Slim World</h1>";
});

$app->get("/hello", function () {
    echo "Hello";
});

$app->get("/json", function () use ($app){
	error_log("flag");
    $app->response->headers->set('Content-Type', 'application/json');

    $app->response->setBody(json_encode(getAllMatches()));
});



/*

Routes for histoTennis

*/




$app->run();



function getAllPlayers(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM Player");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getAllMatches(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match`");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getAllSets(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Set`");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}






?>