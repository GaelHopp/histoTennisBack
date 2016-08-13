<?php
require '../vendor/autoload.php';


$app = new \Slim\Slim();

$app->get('/', function () {
    echo "<h1>Hello Slim World</h1>";
});

$app->get("/hello", function () {
    echo "Hello";
});

$app->run();

?>