<?php
require_once("includes/header.php");

// Get the entity
if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID provided for Entity!");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();


?>
<div class="video-controls watch-nav py-5" id="watch-nav">
    <button class="btn" onclick="goBack()">
        <i class="fas fa-arrow-left h1 text-light"></i> <span class="h1 text-light ms-2">
            <?php echo $video->getTitle(); ?>
        </span>
    </button>
</div>
<div class="watch-container ratio ratio-16x9">
    <video controls > <!-- add autoplay back -->
        <source src='<?= $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>

<?php require("includes/footer.php"); ?>
<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $username; ?>");
</script>