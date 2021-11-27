<?php
require_once("includes/header.php");

if (!isset($_GET["id"])) {
    ErrorMessage::show("No id passed to page");
}

$preview = new PreviewProvider($con, $username);
$categories = new CategoryContainers($con, $username);

?>
<?php require_once("includes/navbar.php"); ?>
<div class="row">
    <div class="col">
        <?php echo $preview->createGategoryPreviewVideo($_GET["id"]) ?>
        <?php echo $categories->showCategory($_GET["id"]); ?>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>