<?php
require 'includes/config.php';
// Init file automatically includes all Classes
require 'includes/init.php';

if (!isset($_SESSION["userLoggedIn"])) {
    header("Location: login.php");
}
$userLoggedIn = $_SESSION["userLoggedIn"];

$account = new Account($con);
$currentUser = $account->retrieveAccount($userLoggedIn);
$username = $currentUser["username"];

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>YourFlix</title>
</head>

<body class="bg-light">

