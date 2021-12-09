<?php
class BillingDetails
{
    private $con, $sqlData;

    public function __construct($con, $username)
    {
        $this->con = $con;

        $query = $con->prepare("SELECT * FROM billingdetails WHERE username=:username");
        $query->bindValue(":username", $username);

        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getNextBillingDate()
    {
        return $this->sqlData["nextBillingDate"];
    }
    public function getAgreementId()
    {
        return $this->sqlData["agreementId"];
    }

    

    public static function insertDetails($con, $username)
    {
        $agreementId = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        $token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(25 / strlen($x)))), 1, 25);
        $nextBillingDate = date('d/m/Y', strtotime("+30 days"));


        // Agreement details from the payment gateway provider

        $query = $con->prepare("INSERT INTO billingDetails (agreementId, nextBillingDate, token, username)
                                VALUES (:agreementId, :nextBillingDate, :token, :username)");
        $query->bindValue(":agreementId", $agreementId);
        $query->bindValue(":token", $token);
        $query->bindValue(":nextBillingDate", $nextBillingDate);
        $query->bindValue(":username", $username);

        return $query->execute();
    }

    public static function removeBilling($con, $username) {
        $query = $con->prepare("UPDATE billingdetails SET nextBillingDate=:null, token=null WHERE username=:username");
        $query->bindValue(":username", $username);
        $query->execute();
    }
    
}
