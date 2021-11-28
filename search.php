<?php
include_once("includes/header.php");

?>
<?php require_once("includes/navbar.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 my-5">
            <div class="textbox-container input-group input-group-lg">
                <input type="text" class="form-control search-input" placeholder="Search for content">
                <label for="" class="input-group-text"><i class="fas fa-search"></i></label>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <!-- Results here -->
            <div class="results">

            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
<script>
    goSearch();
</script>