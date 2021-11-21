<?php
require_once("../../includes/config.php");

if (isset($_POST["videoId"]) && isset($_POST["username"])) {
    $query = $con->prepare("SELECT progress FROM videoProgress 
                            WHERE username=:username AND videoId=:videoId");

    $query->bindValue(":videoId", $_POST["videoId"]);
    $query->bindValue(":username", $_POST["username"]);

    $query->execute();

    // use echo to directly return 1 column
    echo $query->fetchColumn();
} else {
    echo "No video ID or username passed into file.";
}
