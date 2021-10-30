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

    public function createPreviewVideo($entity)
    {
        if ($entity == null) {
            $entity = $this->getRandomEntity();
        };



        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        // TODO: Add subtitle

        return "<div class='preview-container'>
                    <img src='$thumbnail' class='container-fluid px-0 preview-image' hidden>
                    <video autoplay muted class='container-fluid px-0 preview-video' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>
                    <div class='preview-overlay'>
                        <div class='main-details'>
                            <h3 class='text-light'>$name</h3>
                            <div class='buttons'>
                                <button><i <i class='fas fa-play text-reset'></i> Play</button>
                                <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute text-reset'></i></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    private function getRandomEntity()
    {
        $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        return new Entity($this->con, $row);
    }
}
