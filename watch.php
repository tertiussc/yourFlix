<?php
require_once("includes/header.php");

// Get the entity
if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID provided for Entity!");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();

?>

<div class="watch-container ratio ratio-16x9">
    <video controls autoplay>
        <source src='<?= $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>