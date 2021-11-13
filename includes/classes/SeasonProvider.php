<?php

class SeasonProvider
{
    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function createSeasons($entity) {
        $seasons = $entity->getSeasons();

        if (sizeof($seasons) == 0) {
            return;
        }

        $seasonsHtml = "";

        foreach ($seasons as $season) {
            $seasonNumber =  $season->getSeasonNumber();

            $videosHtml = "";
            foreach ($season->getVideos() as $video) {
                $videosHtml .= $this->createVideoSquare($video);
            }

            $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                <div class='videos'>
                                    $videosHtml
                                </div>
                            </div>";
        }
        return $seasonsHtml;
    }

    private function createVideoSquare($videos) {
        $id = $videos->getId();
        $thumbnail = $videos->getThumbnail();
        $name = $videos->getTitle(); //getTitle
        $description = $videos->getDescription();
        $episodeNumber = $videos->getEpisodeNumber();

        return "<a href='watch.php?id=$id' class=''>
                    <div class='episode-container'>
                        <div class='contents'>
                            <img src='$thumbnail'>
                            <div class='video-info'>
                                <h4>$name</h4>
                                <span>$description</span>
                            </div>
                        </div>
                    </div>
                </a>";
    }
}