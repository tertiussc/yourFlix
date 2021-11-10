<?php

class Video
{
    private $con, $sqlData, $entity;


    public function __construct($con, $input)
    {
        $this->con = $con;

        if (is_array($input)) {
            $this->sqlData = $input;
        } else {
            // Get the data from the Databae
            // create Query
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            // Bind value
            $query->bindValue(":id", $input);
            // Execute query
            $query->execute();
            // Assign data to input as an associative array
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
        $this->entity = new Entity($con, $this->sqlData["entityId"]);
    }
}
