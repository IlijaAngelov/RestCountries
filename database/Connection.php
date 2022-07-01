<?php

class Connection {
    public static function make() {
         $host = "127.0.0.1";
         $username = "root";
         $password = "neznam";
         $dbName = "BtoBet";
        try {
            $pdo = new PDO('mysql:host='. $host .';dbname='.$dbName, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
