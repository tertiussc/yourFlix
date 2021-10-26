<?php

/**
 * Create Account and all validations class
 */
class Account
{

    private $con;
    private $errorArray = array();

    public function __construct($con)
    {
        $this->con = $con;
    }

    // validate all fields
    public function register($fn, $ln, $em1, $em2, $un, $pw1, $pw2)
    {
        $this->validateFirstname($fn);
        $this->validateLastname($ln);
        $this->validateUsername($un);
        $this->validateEmails($em1, $em2);
        $this->validatePasswords($pw1, $pw2);

        // Check
        if (empty($this->errorArray)) {
            // this return a true or false because the insertuserDetails return true or false
            return $this->insertUserDetails($fn, $ln, $un, $em1, $pw1);
        }
        return false;
    }

    public function login($em1, $pw1)
    {
        // Hash password
        // $pw1 = password_hash($pw1, PASSWORD_DEFAULT);
        $pw1 = hash("sha512", $pw1);

        // Prepare statement/query
        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em1 AND password=:pw1");
        // bind values
        $query->bindValue(":em1", $em1);
        $query->bindValue(":pw1", $pw1);

        $query->execute();

        if ($query->rowCount() == 1) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }

    public function retrieveAccount($userLoggedIn) {
        $query = $this->con->prepare("SELECT * from users WHERE email=:em1");
        $query->bindValue(":em1", $userLoggedIn);
        // execute the query
        if ($query->execute()) {
            // return the results
            return $query->fetch();
        }
    }

    private function insertUserDetails($fn, $ln, $un, $em1, $pw1)
    {
        // $pw1 = password_hash($pw1, PASSWORD_DEFAULT);
        $pw1 = hash("sha512", $pw1);

        // Prepare statement/query
        $query = $this->con->prepare("INSERT INTO users (firstname, lastName, username, email, password)
                                    VALUES (:fn, :ln, :un, :em1, :pw1)");
        // Bind values
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em1", $em1);
        $query->bindValue(":pw1", $pw1);

        // This return will return true if successfull and false if not
        return $query->execute();
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
            var_dump($em1);
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

    private function validatePasswords($pw1, $pw2)
    {
        if ($pw1 != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if (strlen($pw1) < 8) {
            array_push($this->errorArray, Constants::$passwordCharacters);
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<p class='callout-danger'>" . $error . "</p>";
        }
    }
}
