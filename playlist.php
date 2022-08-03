<?php 
require("includes/config.php");

// MANUAL LOGOUT
// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
    <link rel="stylesheet" type="text/css" href="assets/css/album.css">
    <link rel="stylesheet" type="text/css" href="assets/css/nowPlaying.css">
    <title>Welcome to Slotify</title>
</head>
<body>
    <main class="main">
        <section class="navigation">
            <?php require( __dir__ . '/includes/html/navigation.php') ?>
        </section>
        <section data-main-content class="main-content">
            <?php require( __dir__ . '/includes/html/playlistContent.php') ?>
        </section>
        <section class="now-playing-bar-container">
            <?php require( __dir__ . '/includes/html/nowPlayingBar.php') ?>
        </section>
    </main>
    

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script  src="./assets/javascript/script.js"></script>
</body>
</html>