<?php

class Account
{

    private $con;
    private $errorArray = array();

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function register($fn, $ln, $em1, $em2, $un, $pw1, $pw2)
    {
        $this->validateFirstname($fn);
        $this->validateLastname($ln);
        $this->validateUsername($un);
        $this->validateEmails($em1, $em2);
        $this->validatePasswords($pw1, $pw2);
    }

    private function validateFirstname($fn)
    {
        if (strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastname($ln)
    {
        if (strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($un)
    {
        if (strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateEmails($em1, $em2)
    {
        if (!filter_var($em1, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        if ($em1 != $em2) {
            array_push($this->errorArray, Constants::$emailDontMatch);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em1");
        $query->bindValue(":em1", $em1);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($pw1, $pw2) {
        if ($pw1 != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if (strlen($pw1) < 8 ) {
            array_push($this->errorArray, Constants::$passwordCharacters);
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return $error;
        }
    }
}
