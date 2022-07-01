<?php
session_start();
require "database/Connection.php";
require "src/Country.php";
require "src/Login.php";

$pdo = Connection::make();

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = new BtoBet\Login($pdo);
    $login->loginUser($username, $password);

}
