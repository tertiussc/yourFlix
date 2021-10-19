<?php
// Turn on output buffering (wait for all php code to execute before outputting it to the page)
ob_start();
// start the session
session_start();
// set timezone
date_default_timezone_set('Africa/Johannesburg');

// Connect to the database

try {
    // create database connection using PDO (PHP Database Object)
    $con = new PDO("mysql:dbname=yourflix; host=localhost", "yourflix_admin", "-]Pblx/dNxDQE!WI");
    // Switch on error mode to warning so that the script continue but warns of any errors
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

} catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}

?>