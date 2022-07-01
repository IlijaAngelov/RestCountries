<?php
session_start();
$uid = $_SESSION['uid'];

require "database/Connection.php";
require "src/Country.php";

$request = file_get_contents('php://input');
$data = json_decode($request, true);
$name = $data['name'];
$region = $data['region'];
$population = $data['population'];


$pdo = Connection::make();
$add = new BtoBet\Country($pdo);
$add->addToFavourites($uid, $name, $region, $population);


?>