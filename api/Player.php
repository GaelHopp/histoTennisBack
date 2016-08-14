<?php

include_once("./Base.php");


function getAllPlayers(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Player`");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getPlayerById($id){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Player` WHERE idPlayer = $id");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getPlayerByLastName($lastName){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Player` WHERE lastName LIKE '$lastName'");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getPlayerByFirstName($firstName){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Player` WHERE firstName LIKE '$firstName'");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


?>