<?php
    ob_start();
    session_start();

    $timeZone = date_default_timezone_set("Europe/London");

    $dBConnection = mysqli_connect("localhost", "richardmsi", "Polly11@Polly11", "spotify_clone");

    if(mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }
?>