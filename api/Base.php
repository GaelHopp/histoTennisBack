<?php



function getConnection(){

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "root";

	try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=histoTennis", $username, $password);
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