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

        $html = "<div class='preview-categories container'>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, true);
        }

        return $html . "</div>";
        
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies)
    {
        $categoryId = $sqlData["id"];
        $title = $title == null ? $sqlData["name"] : $title;

        if ($tvShows && $movies) {
            $entities = EntityProvider::getEntities($this->con, $categoryId, 30);
        } else if ($tvShows) {
            // get tv Shows only

        } else {
            // get movie entity
        }

        if (sizeof($entities) == 0) {
            return;
        }

        $entitiesHtml = "";

        foreach ($entities as $entity) {
            $entitiesHtml .= $entity->getName();
            
        }

        return $title . " &rarr; " . $entitiesHtml  . "<br>";
    }
}
