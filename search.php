<?php 
include __DIR__ . '/includes/config.php';
// MANUAL LOGOUT
// session_destroy();

// CHECK IF USER LOGGED IN IF NOT REDIRECT TO REGISTER.PHP
if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script> userLoggedIn = '$userLoggedIn'; </script>";
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
    <link rel="stylesheet" type="text/css" href="assets/css/nowPlaying.css">
    <link rel="stylesheet" type="text/css" href="assets/css/album.css">
    <title>Welcome to Slotify</title>
</head>


<body>
    <main class="main" data-main='main'>
        <section class="navigation">
            <?php require('includes/html/navigation.php') ?>
        </section>
        <section section class="main-content" data-main-content>
            <?php require('includes/html/searchContent.php') ?>
        </section>
        <section class="now-playing-bar-container">
            <?php require('includes/html/nowPlayingBar.php') ?>
        </section>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script  src="./assets/javascript/script.js"></script>
</body>
</html>