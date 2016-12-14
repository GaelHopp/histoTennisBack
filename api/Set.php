<?php

include_once("./Base.php");


function getAllSets(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Set`");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getAllSetsByIdMatch($idMatch){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Set` WHERE idMatch = $idMatch");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function saveSet($set){
	$db = getConnection();
	$winnerGames = $set->winnerGames;
	$loserGames = $set->loserGames;
	$superTieBreak = $set->superTieBreak;
	$tiebreakLoserPoints = $set->tiebreakLoserPoints;
	$idMatch = $set->idMatch;
	$query = "";
	if($tiebreakLoserPoints != null && $tiebreakLoserPoints != ""){
		$query = "INSERT INTO `Set`(winnerGames, loserGames, superTieBreak, tiebreakLoserPoints, idMatch) VALUES ($winnerGames, $loserGames, $superTieBreak, $tiebreakLoserPoints, $idMatch)";
	}else{
		$query = "INSERT INTO `Set`(winnerGames, loserGames, superTieBreak, tiebreakLoserPoints, idMatch) VALUES ($winnerGames, $loserGames, $superTieBreak, NULL, $idMatch)";
	}
	
	
	$stmt = $db->query($query);
}





?>