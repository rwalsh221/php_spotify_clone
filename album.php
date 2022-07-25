<?php 
require("includes/config.php");
// require("includes/classes/Artist.php");
// require("includes/classes/Album.php");
// require("includes/classes/Song.php");

// // MANUAL LOGOUT
// // session_destroy();

// // CHECK IF USER LOGGED IN IF NOT REDIRECT TO REGISTER.PHP
// if(isset($_SESSION['userLoggedIn'])) {
//     $userLoggedIn = $_SESSION['userLoggedIn'];
//     echo "<script> userLoggedIn = '$userLoggedIn'; </script>";
// } else {
//     header("Location: register.php");
// }

// // CHECK FOR ALBUM ID ON URL AND GET FROM DB
// if (isset($_GET['id'])) {
//     $albumId = $_GET['id'];
//     $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums WHERE id='$albumId'");
//     $album = mysqli_fetch_array($albumQuery);

//     $album = new Album($dBConnection, $albumId);
//     $artist = $album->getArtist();
//     } else {
//     header("Location: index.php");
// }
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
        <section section class="main-content album-content" data-main-content>
            <?php require('includes/html/albumContent.php') ?>
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