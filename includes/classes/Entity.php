<?php

class Entity
{
    private $con, $sqlData;


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
            // Assign data to inout as an associative array
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    // get all the data from the object
    public function getId(){
        return $this->sqlData["id"];
    }
    public function getName(){
        return $this->sqlData["name"];
    }
    public function getThumbnail(){
        return $this->sqlData["thumbnail"];
    }
    public function getPreview(){
        return $this->sqlData["preview"];
    }
}
