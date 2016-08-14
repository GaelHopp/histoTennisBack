<?php

include_once("./Base.php");


function getAllPlayers(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Player");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>