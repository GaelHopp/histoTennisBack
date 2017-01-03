<?php



function getConnection(){

$servername = "db4free.net";
$port = 3307;
$username = "histotennis";
$password = "133bfj57";

	try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=histotennis", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}



 ?>