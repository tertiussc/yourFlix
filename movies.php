<?php
require_once("includes/header.php");

$preview = new PreviewProvider($con, $username);
$categories = new CategoryContainers($con, $username);

?>
<?php require_once("includes/navbar.php"); ?>
<div class="row">
    <div class="col">
        <?php echo $preview->createMoviePreviewVideo() ?>
        <?php echo $categories->showMoviesCategories(); ?>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>