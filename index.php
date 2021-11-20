<?php require_once("includes/header.php"); ?>

<div class="row">
    <div class="col">
        <div class="container">
            <h3 class="display-5"><img src="assets/img/tempLogo2.png" alt="Your Flix" class="img-fluid logo"></h3>
            <!-- <a href="register.php" class="text-decoration-none link-secondary">&larr; Register an Account</a>

            <a href="login.php" class="text-decoration-none link-secondary float-end">Log into your Account &rarr;</a> -->

        </div>
        <?php
        // Create the preview content
        $preview = new PreviewProvider($con, $username);
        echo $preview->createPreviewVideo(null);
        ?>
        <?php
        // create the category containers
        $categories = new CategoryContainers($con, $username);
        echo $categories->showAllCatergory()
        ?>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
<!-- body closing in footer -->