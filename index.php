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
    <link rel="stylesheet" type="text/css" href="assets/css/nowPlaying.css">
    <title>Welcome to Slotify</title>
</head>
<body>
    <main class="main">
        <section class="navigation">
            <?php require('includes/html/navigation.php') ?>
        </section>
        <section class="main-content">
            <h1 class="heading__primary main-heading">You Might Also Like</h1>

            <?php 
                $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
                
                while($dbRow = mysqli_fetch_array($albumQuery)) {
                    echo "<div class='album-card'>
                            <a href='album.php?id=" . $dbRow['id'] . "'>
                                <img class='album-image' src='" . $dbRow['artworkPath'] . "'>
                                <p class='album-title'>" . $dbRow['title'] . "</p>
                            </a>
                        </div>";
                }
            ?>
        </section>
        <section class="now-playing-bar-container">
            <?php require('includes/html/nowPlayingBar.php') ?>
        </section>
    </main>
    

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>