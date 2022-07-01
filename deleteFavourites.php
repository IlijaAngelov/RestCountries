<?php
session_start();
$uid = $_SESSION['uid'];

require "database/Connection.php";
require "src/Country.php";

$request = file_get_contents('php://input');
$data = json_decode($request, true);
$id = $data['id'];

$pdo = Connection::make();
$delete = new BtoBet\Country($pdo);
$delete->deleteFromFavourites($id);