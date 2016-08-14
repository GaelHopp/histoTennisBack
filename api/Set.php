<?php

include_once("./Base.php");


function getAllSets(){
	$db = getConnection();
	$stmt = $db->query("SELECT * FROM `Set`");
   return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


?>