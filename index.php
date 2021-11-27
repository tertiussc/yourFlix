<?php
require_once("includes/header.php");
$preview = new PreviewProvider($con, $username);
$categories = new CategoryContainers($con, $username);

?>
<?php require_once("includes/navbar.php"); ?>
<div class="row">
    <div class="col">
        <!-- Nav here -->

        <?php
        // Create the preview content
        echo $preview->createPreviewVideo(null);
        ?>
        <?php
        // create the category containers
        echo $categories->showAllCatergory()
        ?>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
<!-- body closing in footer -->