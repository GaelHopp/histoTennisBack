<?php

include_once("./Base.php");


function getAllMatches(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match`");
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






?>