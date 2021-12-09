<?php
require_once("includes/header.php");
// create user object
$user = new User($con, $username);
// retrieve userdetails and assign to variables
$firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
$lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName();
$email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
$detailsMessage = '';
$passwordMessage = '';
$isSubscribed = $user->getIsSubscribed();
$subscriptionDescription = ($isSubscribed == 1) ? 'You are subscribed' : 'Please subscribe';
$subscriptionButtonText = ($isSubscribed == 1) ? 'Unsubscribe' : 'Subscribe';
$subscriptionUpdatedStatus = '';
$billingDetails = new BillingDetails($con, $username);
$nextBillingDate = ($user->getIsSubscribed() == 1) ? " your next billing date is " . $billingDetails->getNextBillingDate() : '';

// manage form submission
if (isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeLoginEmail($_POST["email"]);

    if ($account->updateDetails($firstName, $lastName, $email, $username)) {
        $detailsMessage = "<div class='callout-success'>
                            Details updated successfully!
                        </div>";
    } else {
        $errorMessage = $account->getFirstError();
        $detailsMessage = "<div class='callout-danger'>
                            $errorMessage
                        </div>";
    }
}

if (isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $confirmPassword = FormSanitizer::sanitizeFormPassword($_POST["confirmPassword"]);

    if ($account->updatePassword($oldPassword, $newPassword, $confirmPassword, $username)) {
        $passwordMessage = "<div class='callout-success'>
                            Password updated successfully!
                        </div>";
    } else {
        $errorMessage = $account->getFirstError();
        $passwordMessage = "<div class='callout-danger'>
                            $errorMessage
                        </div>";
    }
}

if (isset($_POST["updateSubscription"])) {
    $user = new User($con, $username);

    if ($user->updateSubscription($username, $_POST["updateSubscription"])) {
        $subscriptionUpdatedStatus = "<div class='callout-success'>
                                        Subscription updated successfully!
                                    </div>";
        // update account details
        $result = BillingDetails::insertDetails($con, $username); //if billing details already exist then update next billing date 
        header("Refresh: 2");
    } else {
        $subscriptionUpdatedStatus = "<div class='callout-danger'>
                                        Subscription was not updated!
                                    </div>";
        header("Refresh: 2");
    }
    // update users's account status
}



?>
<?php require_once("includes/navbar.php"); ?>
<!-- profile page -->
<div class="container">
    <div class="row">
        <div class="col-8">
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
                    <label class="visually-hidden" for="email">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $email; ?>">
                </div>
                <div class="message mb-3">
                    <?php echo $detailsMessage; ?>
                </div>
                <div class="mb-3">
                    <input class="form-control btn btn-primary" type="submit" name="saveDetailsButton" value="Update details">
                </div>

            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-8">
            <hr class="bg-dark">
        </div>
    </div>
    <div class="row">
        <div class="col-8">
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
                <div class="message mb-3">
                    <?php echo $passwordMessage; ?>
                </div>
                <div class="mb-3">
                    <input class="form-control btn btn-primary" type="submit" name="savePasswordButton" value="Change password">
                </div>

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <hr class="bg-dark">
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <form method="POST" class="bg-dark p-3 rounded">
                <h2 class=" text-light">Subscription</h2>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="isSubscribed" <?php echo ($isSubscribed == 1) ? "checked" : ""; ?> disabled>
                    <label class="form-check-label text-light" for="isSubscribed"><?= $subscriptionDescription .$nextBillingDate ?></label>
                    <!-- <a href="billing.php">Update Billing</a> -->
                </div>
                <div class="message mb-3">
                    <?php echo $subscriptionUpdatedStatus; ?>
                </div>
                <div class="mb-3">
                    <input class="form-control btn btn-primary" type="submit" name="updateSubscription" value="<?= $subscriptionButtonText ?>">
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("includes/footer.php"); ?>
<script>

</script>