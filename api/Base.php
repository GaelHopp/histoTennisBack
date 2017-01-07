<?php



function getConnection(){

$servername = "eu-cdbr-west-01.cleardb.com";
$port = 3307;
$username = "ba9e92470820ca";
$password = "f4276cd2";

	try {
    $conn = new PDO("mysql:host=$servername;dbname=heroku_0e0bc9ee8b484c9", $username, $password);
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