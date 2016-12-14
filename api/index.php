<?php
include ("./Player.php");
include ("./Match.php");
include ("./Set.php");
require '../vendor/autoload.php';

$app = new \Slim\Slim();
$app->response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
$app->response->headers->set('Content-Type', 'application/json');
$app->response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
$app->response->headers->set('Access-Control-Allow-Origin', '*');


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

    $matches = constructMatchesWithSets($matches);
   
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

$app->get("/matches/with/tiebreak", function () use ($app){
	
	$matches = getMatchWithTieBreak(true);    
	$matches = constructMatchesWithSets($matches);

    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});

$app->get("/matches/without/tiebreak", function () use ($app){
	
	$matches = getMatchWithTieBreak(false);    
	$matches = constructMatchesWithSets($matches);

    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});

$app->get("/matches/with/supertiebreak", function () use ($app){
	
	$matches = getMatchWithSuperTieBreak(true);    
	$matches = constructMatchesWithSets($matches);

    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});

$app->get("/matches/without/supertiebreak", function () use ($app){
	
	$matches = getMatchWithSuperTieBreak(false);    
	$matches = constructMatchesWithSets($matches);

    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});


$app->get("/matches/place/indoor", function () use ($app){
	
	$matches = getMatchIndoor();    
	$matches = constructMatchesWithSets($matches);

    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});

$app->get("/matches/place/outdoor", function () use ($app){
	
	$matches = getMatchOutdoor();    
	$matches = constructMatchesWithSets($matches);

    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matches));
});

$app->post("/match/new", function () use ($app){

    $match = $app->request->getBody();
    saveMatch(json_decode($match));
    $app->response->setBody(json_encode($match));
});

$app->run();



/*

Treatment functions


*/



function constructMatchesWithSets($matches){

foreach ($matches as $idMatchArray => $arrayDetails) {
    	
	$idMatch = $arrayDetails['idMatch']; 
    $idWinner = $arrayDetails['idWinner']; 
    $idLoser = $arrayDetails['idLoser']; 
	$matches[$idMatchArray]['sets'] = getSetsForMatch($idMatch);
    $matches[$idMatchArray]['winner'] = getPlayerById($idWinner);
    $matches[$idMatchArray]['loser'] = getPlayerById($idLoser);

}

return $matches;

}



function getSetsForMatch($idMatch){
	return getAllSetsByIdMatch($idMatch);
}








?>