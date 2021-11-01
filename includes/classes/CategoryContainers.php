<?php

class CategoryContainers
{
    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function showAllCatergory()
    {
        $query = $this->con->prepare("SELECT * from categories ORDER BY id");
        $query->execute();

        $html = "<div class='preview-categories'>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .=$row["name"];
        }

        return $html . "</div>";

    }
}
