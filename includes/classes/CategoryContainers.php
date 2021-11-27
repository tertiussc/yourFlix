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
    
    public function showTVShowCategories()
    {
        $query = $this->con->prepare("SELECT * from categories ORDER BY id");
        $query->execute();

        $html = "<div class='preview-categories container'>
                    <h1 class='display-6'>TV Shows</h1>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, false);
        }

        return $html . "</div>";
    }

    public function showMoviesCategories()
    {
        $query = $this->con->prepare("SELECT * from categories ORDER BY id");
        $query->execute();

        $html = "<div class='preview-categories container'>
                    <h1 class='display-6'>Movies</h1>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, false, true);
        }

        return $html . "</div>";
    }

    public function showCategory($categoryId, $title = null){
        $query = $this->con->prepare("SELECT * from categories WHERE id=:id");
        $query->bindValue(":id", $categoryId);
        $query->execute();

        $html = "<div class='preview-categories container no-scroll'>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, $title, true, true);
        }

        return $html . "</div>";
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies)
    {
        $categoryId = $sqlData["id"];
        $title = $title == null ? $sqlData["name"] : $title;

        if ($tvShows && $movies) {
            $entities = EntityProvider::getShowsEntities($this->con, $categoryId, 30);
        } else if ($tvShows) {
            $entities = EntityProvider::getEntities($this->con, $categoryId, 30);


        } else {
            $entities = EntityProvider::getMoviesEntities($this->con, $categoryId, 30);
        }

        if (sizeof($entities) == 0) {
            return;
        }

        $entitiesHtml = "";

        $previewProvider = new PreviewProvider($this->con, $this->username);

        foreach ($entities as $entity) {
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
        }

        return "<div class='category'>
                    <a href='category.php?id=$categoryId' class='text-decoration-none'>
                        <h3>$title</h3>
                    </a>
                    <div class='entities'>
                        $entitiesHtml
                    </div>
                </div>";
    }


}
