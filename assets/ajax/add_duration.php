<?php
    require_once("../../includes/config.php");

    if (isset($_POST["videoId"]) && isset($_POST["username"])) {
        echo $_POST["videoId"] . $_POST["username"];
    } else {
        echo "No video ID or username passed into file.";
    }
    
?>