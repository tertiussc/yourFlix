<?php
require_once("PayPal-PHP-SDK/autoload.php");

// Authenticate against the paypal app
$apiContext = new \PayPal\Rest\ApiContext(
    'ATyNo-FgDscH_NqCaaqRygAhxpE5VYLrNqVe6cpunalROZLXmzIOnLIh2L0SjKg70Yk5wdiKd86knRol',     // Client ID
    'EKlkYhPbg9_XSlvctq64hv1Pmuv4lyRPUrC33HkwEOs5eRLRqLbGUHl0yw5F7xhhB193M2a7VMk277e_'      //ClientSecret
);

