<?php
if (isset($_POST["submit"])) {
    echo 'Form Submitted';
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
    <!-- Boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <title>Welcome to yourFlix</title>
</head>

<body class="register">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" class="p-3 m-5 box bg-white rounded">
                    <a href="/yourflix/">
                        <img class="img-fluid logo mb-2" src="assets/img/tempLogo2sm.png" alt="YourFlix logo" title="YourFlix logo">
                    </a>
                    <h4 class="text-dark mb-0">Sign In</h4>
                    <p class="text-secondary">to continue to YourFlix</p>

                    <div class="mb-3">
                        <label for="email1" class="form-label visually-hidden">Email</label>
                        <input type="email" class="form-control" name="email1" id="email1" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password1" class="form-label visually-hidden">Password</label>
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
                    </div>
                    <div class="mb-3 d-grid">
                        <button class="btn btn-primary text-uppercase" type="submit" name="submit"><i class="bi bi-person-plus-fill text-light"></i> Register</button>
                    </div>
                    <div class="row mb-3">
                        <a class="col-md-6 link-secondary text-decoration-none" href="/yourflix/">&larr; Back to home page</a>
                        <a class="col-md-6 link-secondary text-decoration-none text-end login-link" href="register.php">No account? Register &rarr;</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>