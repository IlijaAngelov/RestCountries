<?php

namespace BtoBet;

class Country {

    protected $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addToFavourites($uid, $name, $region, $population) {
        $stmt = $this->pdo->prepare("INSERT INTO favCountries (`uid`, `name`, `region`, `population`) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $uid);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $region);
        $stmt->bindParam(4, $population);
        try {
            $stmt->execute();
        } catch (Exception $e){
            die("Error occured: " . $e->getMessage());
        }
    }

    public function getFavCountries($uid) {
        $stmt = $this->pdo->prepare("SELECT * FROM favCountries WHERE uid = ?");
        $stmt->bindParam(1, $uid);
        try {
            $stmt->execute();
        } catch (Exception $e){
            die("Error occured: " . $e->getMessage());
        }

        $results = $stmt->fetchAll();
        return $results;
    }

    public function deleteFromFavourites($id) {
        $stmt = $this->pdo->prepare("DELETE FROM favCountries WHERE id = ?");
        $stmt->bindParam(1, $id);
        try {
            $stmt->execute();
        } catch (Exception $e){
            die("Error occured: " . $e->getMessage());
        }
    }
}

?>