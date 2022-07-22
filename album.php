<?php 
require("includes/config.php");
require("includes/classes/Artist.php");
require("includes/classes/Album.php");
require("includes/classes/Song.php");

// MANUAL LOGOUT
// session_destroy();

// CHECK IF USER LOGGED IN IF NOT REDIRECT TO REGISTER.PHP
if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

// CHECK FOR ALBUM ID ON URL AND GET FROM DB
if (isset($_GET['id'])) {
    $albumId = $_GET['id'];
    $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums WHERE id='$albumId'");
    $album = mysqli_fetch_array($albumQuery);

    $album = new Album($dBConnection, $albumId);
    $artist = $album->getArtist();
    } else {
    header("Location: index.php");
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
    <main class="main">
        <section class="navigation">
            <?php require('includes/html/navigation.php') ?>
        </section>
        <section class="album-content">
            
                <div class="album-container">
                    <div class="album-container__img">
                        <img src="<?php echo $album->getArtworkPath() ?>" alt="album artwork">
                    </div>
                    <div class="album-container__info">
                        <h1><?php echo $album->getTitle() ?></h1>
                        <p class="album-container-info--artist"><?php echo 'by ' . $artist->getName() ?></p>
                        <p class="album-container-info--songs"><?php echo $album->getNumberOfSongs() . ' songs' ?></p>
                    </div>
                </div>
                <div class="tracklist-container">
                    <ul>
                        <?php 
                            $songIdArray = $album->getSongIds();

                            $songCount = 1;

                            foreach($songIdArray as $songId) {
                                $albumSong = new Song($dBConnection, $songId);
                                // RETURNS NEW ARTIST OBJECT
                                $songArtist = $albumSong->getArtist();
                                
                                echo "<li>
                                        <div class='tracklist-container__track-count'>
                                            <span class='tracklist-container__track-count--play' onClick='setTrack(" . $albumSong->getSongId() . ", tempPlaylist, true)'><ion-icon name='play'></ion-icon></span>
                                            <span class='tracklist-container__track-count--count'>$songCount</span>
                                        </div>
                                        <div class='tracklist-container__track-info'>
                                            <div class='tracklist-container__track-title'>" . $albumSong->getSongTitle() . "</div>
                                            <div class='tracklist-container__track-artist'>" . $songArtist->getName() ."</div>
                                        </div>
                                        <div class='tracklist-container__track-options'><ion-icon name='ellipsis-horizontal'></ion-icon></div>
                                        <div class='tracklist-container__track-duration'>" . $albumSong->getDuration() . "</div>
                                    </li>";

                                $songCount += 1;
                            }
                        ?>
                       <script> 
                       document.addEventListener("DOMContentLoaded", function(event) {let tempSongIds = '<?php echo json_encode($songIdArray); ?>'
                            tempPlaylist = JSON.parse(tempSongIds);
                            console.log(tempPlaylist)})
                            
                        
</script>
                    </ul>
                </div>
            
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