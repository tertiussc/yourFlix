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
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            // Bind value
            $query->bindValue(":id", $input);
            // Execute query
            $query->execute();
            // Assign data to input as an associative array
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
        $this->entity = new Entity($con, $this->sqlData["entityId"]);
    }

    public function incrementViews(){
        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindValue(":id", $this->getId());
        $query->execute();
    }

    public function getId(){
        return $this->sqlData["id"];
    }
    public function getTitle(){
        return $this->sqlData["title"];
    }
    public function getDescription(){
        return $this->sqlData["description"];
    }
    public function getFilePath(){
        return $this->sqlData["filePath"];
    }
    public function getThumbnail(){
        return $this->entity->getThumbnail();
    }
    public function getEpisodeNumber(){
        return $this->sqlData["episode"];
    }
    public function getSeasonNumber(){
        return $this->sqlData["season"];
    }
    public function getEntityId(){
        return $this->sqlData["entityId"];
    }


    public function getSeasonAndEpisode(){
        if($this->isMovie()) {
            return;
        }

        $season = $this->getSeasonNumber();
        $episode = $this->getEpisodeNumber();

        return "Season $season, Episode $episode";

    }
    public function isMovie() {
        return $this->sqlData["isMovie"] == 1;
    }

}
