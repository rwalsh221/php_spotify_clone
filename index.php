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
    <script src="assets/javascript/register.js" defer></script> 
    <title>Welcome to Slotify</title>
</head>
<body>
    <div class="now-playing-bar-container">
        <div class="now-playing-bar">
            <div class="now-playing-bar__left">
                <div class="now-playing__img">
                    <img src="./assets//images/now_playing.jpg" alt="now playing">
                </div>
                <div class="now-playing__info">
                    <p class="now-playing__song-title">i want to be adored</p>
                    <p class="now-playing__song-artist">the stone roses</p>
                </div>
            </div>
            <div class="now-playing-bar__center">
                <div class="now-playing-bar__controls">
                    <button class="now-playing-bar__button" title="Shuffle"><ion-icon name="shuffle-outline"></ion-icon></ion-icon></button>
                    <button class="now-playing-bar__button" title="Skip back"><ion-icon name="play-skip-back"></ion-icon></button>
                    <button class="now-playing-bar__button button-play" title="Play"><ion-icon name="play-circle-outline"></ion-icon></button>
                    <button class="now-playing-bar__button" title="Skip forward"><ion-icon name="play-skip-forward"></ion-icon></button>
                    <button class="now-playing-bar__button" title="Repeat"><ion-icon name="repeat-outline"></ion-icon></button>
                </div>
                <div class="now-playing-bar__progress-bar">
                    <span class="progress-time current">0.00</span>
                    <div class="progress-bar">
                        <div class="progress-bar__background">
                            <div class="progress-bar__foreground"></div>
                        </div>
                    </div>
                    <span class="progress-time remaining">0.00</span>
                </div>
            </div>
            <div class="now-playing-bar__right">
                <button class="now-playing-bar__button"><ion-icon name="volume-medium-outline"></ion-icon></button>
                <div class="now-playing__volume-bar">
                    <div class="volume-bar__background">
                        <div class="volume-bar__foreground"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>