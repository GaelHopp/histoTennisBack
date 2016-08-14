<?php

include_once("./Base.php");


function getAllMatches(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Match`");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


?>