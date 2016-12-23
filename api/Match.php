<?php

include_once("./Base.php");


function getAllMatches(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` ORDER BY dateMatch DESC");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);


}

function getMatchById($id){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE idMatch = $id");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


function getMatchWonByIdPlayer($id){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE idWinner = $id");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchLossByIdPlayer($id){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE idLoser = $id");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchByDate($date){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE dateMatch LIKE '$date'");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchBeforeDate($date){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE dateMatch <= '$date'");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchAfterDate($date){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE dateMatch >= '$date'");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchBetweenDates($dateBefore, $dateAfter){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE dateMatch >= '$dateBefore' AND dateMatch <= '$dateAfter'");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchWithTieBreak($tiebreak){
	$db = getConnection();
	if($tiebreak == true)
		$query = "SELECT * from `Match` WHERE idMatch IN (SELECT idMatch FROM `Set` WHERE tiebreakLoserPoints IS NOT NULL)";
	else
		$query = "SELECT * from `Match` WHERE idMatch NOT IN (SELECT idMatch FROM `Set` WHERE tiebreakLoserPoints IS NOT NULL)";
	$stmt = $db->query($query);
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchWithSuperTieBreak($supertiebreak){
	$db = getConnection();
	if($supertiebreak == true)
		$query = "SELECT * from `Match` WHERE idMatch IN (SELECT idMatch FROM `Set` WHERE superTieBreak IS TRUE)";
	else
		$query = "SELECT * from `Match` WHERE idMatch NOT IN (SELECT idMatch FROM `Set` WHERE superTieBreak IS TRUE)";
	$stmt = $db->query($query);
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


function getMatchIndoor(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE indoorMatch IS TRUE");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getMatchOutdoor(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match` WHERE indoorMatch IS FALSE");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


function saveMatch($match){
	$db = getConnection();
	$idWinner = $match->idWinner;
	$idLoser = $match->idLoser;
	$dateMatch = $match->dateMatch;
	$indoorMatch = $match->indoorMatch;
	$stmt = $db->query("INSERT INTO `Match`(idWinner, idLoser, dateMatch, indoorMatch) VALUES ($idWinner, $idLoser, '$dateMatch', $indoorMatch)");
	$lastId = $db->lastInsertId();

	foreach($match->sets as $set){
		$set->idMatch = $lastId;
		saveSet($set);
	}
}

function createMatchLive($match){
	$db = getConnection();
	$player1 = $match->player1;
	$player2 = $match->player2;
	$set1Player1 = $match->set1Player1;
	$set1Player2 = $match->set1Player2;
	$set2Player1 = $match->set2Player1;
	$set2Player2 = $match->set2Player2;
	$set3Player1 = $match->set3Player1;
	$set3Player2 = $match->set3Player2;
	$player1Serving = 1;
	if($match->player1Serving == false){
		$player1Serving = 0;
	}
	$stmt = $db->query("INSERT INTO `MatchLive`(player1, player2, set1Player1, set1Player2, set2Player1, 
												set2Player2, set3Player1, set3Player2, player1Serving) 
												VALUES ('$player1', '$player2', $set1Player1, $set1Player2, $set2Player1, 
												$set2Player2, $set3Player1, $set3Player2, $player1Serving)");

	
}

function updateMatchLive($match){
	$db = getConnection();
	$idMatchLive = $match->idMatchLive;
	$player1 = $match->player1;
	$player2 = $match->player2;
	$set1Player1 = $match->set1Player1;
	$set1Player2 = $match->set1Player2;
	$set2Player1 = $match->set2Player1;
	$set2Player2 = $match->set2Player2;
	$set3Player1 = $match->set3Player1;
	$set3Player2 = $match->set3Player2;
	$isPlayer1Serving = $$match->isPlayer1Serving;
	$stmt = $db->query("UPDATE `MatchLive` SET player1 = '$player1', player2 = '$player2', set1Player1 = $set1Player1, 
												set1Player2 = $set1Player2, set2Player1 = $set2Player1, set2Player2 = $set2Player2, 
												set3Player1 = $set3Player1, set3Player2 = $set3Player2, isPlayer1Serving = $isPlayer1Serving 
												WHERE idMatchLive = $idMatchLive"); 
											

	
}


function getAllMatchesLive(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `MatchLive` ORDER BY idMatchLive ASC");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}








?>