<?php
// register a autoloader to load class files automatically
require 'includes/init.php';
require_once 'includes/config.php';
// require_once 'includes/classes/FormSanitizer.php';

echo "<div style='color: #ddd; background-color: #333; min-height: 50px'>";
echo "<h3 style='color: #ddd'>PHP Code</h3>";

// create Account class instance
$account = new Account($con);


if (isset($_POST["submit"])) {
    // Sanitize the input
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email1 = FormSanitizer::sanitizeFormEmail($_POST["email1"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
    $password1 = FormSanitizer::sanitizeFormPassword($_POST["password1"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    // Validate input from Account class
    $account->register($firstName, $lastName, $username, $email1, $email2, $password1, $password2);
}

echo "</div>";


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
                    <h4 class="text-dark mb-0">Sign Up</h4>
                    <p class="text-secondary">to continue to YourFlix</p>

                    <!-- First name -->
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <div class="mb-3">
                        <label for="firstName" class="form-label visually-hidden">First name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name" required1>
                    </div>

                    <!-- Last name -->
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <div class="mb-3">
                        <label for="lastName" class="form-label visually-hidden">Last name</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" required1>
                    </div>

                    <!-- Username -->
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <div class="mb-3">
                        <label for="username" class="form-label visually-hidden">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required1>
                    </div>

                    <!-- Email 1 -->
                    <?php echo $account->getError(Constants::$emailDontMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <div class="mb-3">
                        <label for="email1" class="form-label visually-hidden">Email</label>
                        <input type="email" class="form-control" name="email1" id="email1" placeholder="Enter email" required1>
                    </div>
                    <!-- Email 2 -->
                    <div class="mb-3">
                        <label for="email2" class="form-label visually-hidden">Confirm email</label>
                        <input type="email" class="form-control" name="email2" id="email2" placeholder="Confirm email" required1>
                    </div>

                    <!-- Password 1 -->
                    <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                    <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    <div class="mb-3">
                        <label for="password1" class="form-label visually-hidden">Password</label>
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required1>
                    </div>
                    <!-- Password 2 -->
                    <div class="mb-3">
                        <label for="password2" class="form-label visually-hidden">Confirm Password</label>
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm password" required1>
                    </div>

                    <div class="mb-3 d-grid">
                        <button class="btn btn-primary text-uppercase" type="submit" name="submit"><i class="bi bi-person-plus-fill text-light"></i> Register</button>
                    </div>
                    <div class="row mb-3">
                        <a class="col-md-6 link-secondary text-decoration-none" href="/yourflix/">&larr; Back to home page</a>
                        <a class="col-md-6 link-secondary text-decoration-none text-end login-link" href="login.php">Have account? Login &rarr;</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>