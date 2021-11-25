<?php
require_once("includes/header.php");

// Get the entity
if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID provided for Entity!");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();

$upNextVideo = VideoProvider::getUpNext($con, $video)

?>
<!-- Go back overlay -->
<div class="video-controls watch-nav py-5" id="watch-nav">
    <button class="btn" onclick="goBack()">
        <i class="fas fa-arrow-left h1 text-light"></i> <span class="h1 text-light ms-2">
            <?php echo $video->getTitle(); ?>
        </span>
    </button>
</div>

<!-- Up next overlay -->
<div class="video-controls up-next" style="display: none;">
    <button class="btn" onclick="restartVideo();">
        <i class="fas fa-redo h1 text-light"></i>
    </button>
    <div class="up-next-container">
        <h2 class="text-light">Up Next: </h2>
        <h3 class="text-light"><?php echo $upNextVideo->getTitle() ?></h3>
        <h3 class="text-light"><?php echo $video->getSeasonAndEpisode(); ?></h3>
        <button class="btn play-next" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>);">
            <i class="fas fa-play text-light h2"></i><span class="text-light h2 ms-4">Play</span>
        </button>
    </div>
</div>

<!-- Video Player -->
<div class="watch-container ratio ratio-16x9">
    <video controls autoplay onended="showUpNext();">
        <!-- add autoplay back -->
        <source src='<?= $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>

<?php require("includes/footer.php"); ?>
<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $username; ?>");
</script>