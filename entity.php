<?php
require_once "includes/header.php";

$preview = new PreviewProvider($con, $username);

// Get the entity
if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID provided for Entity!");
}

$entityId = $_GET["id"];
$entity = new Entity($con, $entityId);

?>

<body class="bg-light">
    <div class="">
        <div class="row">
            <div class="col">
                <div class="container">
                    <h3 class="display-5">Welcome to yourFlix</h3>
                    <a href="register.php" class="text-decoration-none link-secondary">&larr; Register an Account</a>

                    <a href="login.php" class="text-decoration-none link-secondary float-end">Log into your Account &rarr;</a>
                    <?php echo $preview->createPreviewVideo($entity); ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- custom scrpts -->
    <script src="assets/js/script.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>