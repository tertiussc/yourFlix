<?php
// Session has to be started to have access to sessions
session_start();
session_destroy();
// redirect to login
header("location: login.php");

?>