<?php

namespace BtoBet;

class Signup
{
    protected $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function emptyInput($username, $password, $passwordRepeat) {
        if(empty($username) || empty($password) || empty($passwordRepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function invalidUsername($username) {
        if(!preg_match("/^[a-zA-z0-9]*$/", $username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function passwordMatch($password, $passwordRepeat) {
        if($password !== $passwordRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function usernameExists($username){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindParam(1, $username);
        if(!$stmt->execute()) {
            $stmt = null;
            header("Location: signup.php?error=stmtFailed");
            exit();
        }

        if($stmt->rowCount() > 0 ) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    public function createNewUser($username, $password, $passwordRepeat, $email) {
        if(empty($username) || empty($password) || empty($passwordRepeat)) {
            header("Location: signup.php?error=emptyInput");
            exit();
        }

        if(!preg_match("/^[a-zA-z0-9]*$/", $username)) {
            header("Location: signup.php?error=invalidUsername");
            exit();
        }

        if($password !== $passwordRepeat) {
            header("Location: signup.php?error=passwordMismatch");
            exit();
        }

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindParam(1, $username);
        if(!$stmt->execute()) {
            $stmt = null;
            header("Location: signup.php?error=stmtFailed");
            exit();
        }

        if($stmt->rowCount() > 0 ) {
            header("Location: signup.php?error=UsernameAlreadyExists");
            exit();
        }

        $stmt = $this->pdo->prepare("INSERT INTO users (`username`, `password`, `email`) VALUES (?, ?, ?)");
        $hashPass = crypt($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$username, $hashPass, $email])) {
            $stmt = null;
            header("Location: signup.php?error=stmtFailed");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }

    public function signupUser($username, $password, $passwordRepat, $email) {
        if($this->emptyInput() == false) {
            header("Location: signup.php?error=emptyInput");
            exit();
        }
        if($this->invalidUsername() == false) {
            header("Location: signup.php?error=invalidUsername");
            exit();
        }
        if($this->passwordMatch() == false) {
            header("Location: signup.php?error=passwordMismatch");
            exit();
        }
        if($this->usernameExists() == false) {
            header("Location: signup.php?error=UsernameAlreadyExists");
        }

        $this->createNewUser($username, $password);
    }
}