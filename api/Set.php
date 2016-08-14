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





?>