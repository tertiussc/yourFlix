<?php
    require 'includes/config.php';
    require 'includes/init.php';

    if (!isset($_SESSION["userLoggedIn"])) {
        header("Location: login.php");
    }

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>YourFlix</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="display-5">Welcome to yourFlix</h3>
            <a href="register.php" class="text-decoration-none link-secondary">Register an Account</a>
            <br>
            <a href="login.php" class="text-decoration-none link-secondary">Log into your Account</a>
        </div>
    </div>
</div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>