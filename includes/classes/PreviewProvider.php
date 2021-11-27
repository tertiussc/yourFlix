<?php

/**
 * Create a preview section
 */
class PreviewProvider
{
    private $con;
    private $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function createTVShowPreviewVideo(){
        $entitiesArray = EntityProvider::getShowsEntities($this->con, null, 1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createGategoryPreviewVideo($categoryId)
    {
        $entitiesArray = EntityProvider::getEntities($this->con, $categoryId, 1);

        if (sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createMoviePreviewVideo(){
        $entitiesArray = EntityProvider::getMoviesEntities($this->con, null, 1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No movies to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createPreviewVideo($entity)
    {
        if ($entity == null) {
            $entity = $this->getRandomEntity();
        };



        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        $videoId = VideoProvider::getEntityVideoForUser($this->con, $id, $this->username);
        $video = new Video($this->con, $videoId);

        $inProgress = $video->isInProgress($this->username);
        $playButtonText = $inProgress ? "Continue" : "Play";

        $seasonEpisode = $video->getSeasonAndEpisode();
        $subHeading = $video->isMovie() ? "" : "<h5 class='text-light'>$seasonEpisode</h5>";

        return "<div class='preview-container'>
                    <img src='$thumbnail' class='container-fluid px-0 preview-image' hidden>
                    <video autoplay muted class='container-fluid px-0 preview-video' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>
                    <div class='preview-overlay'>
                        <div class='main-details'>
                            <h3 class='text-light'>$name</h3>
                            $subHeading
                            <div class='buttons'>
                                <button onclick='watchVideo($videoId)'><i <i class='fas fa-play text-reset'></i> $playButtonText</button>
                                <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute text-reset'></i></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    public function createEntityPreviewSquare($entity)
    {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='preview-container small'>
                        <img src='$thumbnail' title='$name' class=''>
                    </div>
                </a>";
    }

    private function getRandomEntity()
    {
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}
