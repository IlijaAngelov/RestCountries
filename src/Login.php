<?php

namespace BtoBet;

class Login
{
    protected $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function loginUser($username, $password)
    {
        $sth = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $sth->bindParam(1, $username);
        $sth->execute();
        $result = $sth->fetchAll();
        $comparePasswords = password_verify($password, $result[0]["password"]);

        if ($sth->rowCount() > 0) {
            session_start();
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['username'] = $username;
        } else {
            header("Location: login.php?error=usernotfound");
            exit();
        }

        if ($comparePasswords == true) {
            header("Location: index.php");
            exit();
        } else {
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            header("Location: login.php?error=wrongpassword");
        }
    }
}