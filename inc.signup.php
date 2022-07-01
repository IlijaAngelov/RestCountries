<?php
session_start();
require "database/Connection.php";
require "src/Signup.php";
$pdo = Connection::make();

if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordrepeat'];
    $email = $_POST['email'];

    $signup = new BtoBet\Signup($pdo);
    $signup->createNewUser($username, $password, $passwordRepeat, $email);
}