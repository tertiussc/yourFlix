<?php
require_once("includes/header.php");
// create user object
$user = new User($con, $username);
// retrieve userdetails and assign to variables
$firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
$lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName();
$email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();


?>
<?php require_once("includes/navbar.php"); ?>
<!-- profile page -->
<div class="container">
    <div class="row">
        <div class="col-6">
            <form method="POST" class="bg-dark p-3 rounded">

                <h2 class="text-light">User details</h2>
                <div class="mb-3">
                    <label class="visually-hidden" for="firstName">First Name</label>
                    <input class="form-control" type="text" name="firstName" placeholder="First Name" value="<?= $firstName; ?>">
                </div>
                <div class="mb-3">
                    <label class="visually-hidden" for="lastName">Last Name</label>
                    <input class="form-control" type="text" name="lastName" placeholder="Last Name" value="<?= $lastName; ?>">
                </div>
                <div class="mb-3">
                    <label class="visually-hidden" for="email">First Name</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $email; ?>">
                </div>
                <div class="mb-3">
                    <input class="form-control btn btn-primary" type="submit" name="saveDetailsButton" value="Save">
                </div>

            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-6">
            <hr class="bg-dark">
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <form method="POST" class="bg-dark p-3 rounded">
                <h2 class="text-light">Update password</h2>
                <div class="mb-3">
                    <label class="visually-hidden" for="oldPassword">Old password</label>
                    <input class="form-control" type="password" name="oldPassword" placeholder="Old password">
                </div>
                <div class="mb-3">
                    <label class="visually-hidden" for="newPassword">New password</label>
                    <input class="form-control" type="password" name="newPassword" placeholder="New password">
                </div>
                <div class="mb-3">
                    <label class="visually-hidden" for="confirmPassword">Confirm new Password</label>
                    <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm new password">
                </div>
                <div class="mb-3">
                    <input class="form-control btn btn-primary" type="submit" name="savePasswordButton" value="Save">
                </div>

            </form>
        </div>
    </div>
</div>
<?php require_once("includes/footer.php"); ?>