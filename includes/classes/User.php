<?php
class User
{
    private $con, $sqlData;

    public function __construct($con, $username)
    {
        $this->con = $con;

        $query = $con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindValue(":username", $username);

        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFirstName()
    {
        return $this->sqlData["firstName"];
    }

    public function getLastName()
    {
        return $this->sqlData["lastName"];
    }

    public function getUsername()
    {
        return $this->sqlData["username"];
    }
    public function getEmail()
    {
        return $this->sqlData["email"];
    }

    public function getIsSubscribed()
    {
        return $this->sqlData["isSubscribed"];
    }

    /**
     * Update the user's subscription
     */
    public function updateSubscription($username, $subscriptionStatus) {
        $isSubscribed = ($subscriptionStatus == 'Subscribe') ? 1 : 0;

        $query = $this->con->prepare("UPDATE users SET isSubscribed=:isSubscribed WHERE username=:username");
        $query->bindValue(":isSubscribed", $isSubscribed);
        $query->bindValue(":username", $username);

        return $query->execute();
    }
}
