<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/Artist.php';
include __DIR__ . '/../classes/Album.php';
include __DIR__ . '/../classes/Song.php';

// MANUAL LOGOUT
// session_destroy();

// CHECK IF USER LOGGED IN IF NOT REDIRECT TO REGISTER.PHP
if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script> userLoggedIn = '$userLoggedIn'; </script>";
} else {
    header("Location: register.php");
}

if (isset($_GET['id'])) {
    $artistId = $_GET['id'];
    

    $artist = new Artist($dBConnection, $artistId);
    
    } else {
    header("Location: index.php");
}
?>

<div class="artist-container">
        <div class="artist-container__heading">
            <h1 class="artist__heading heading__primary"><?php echo $artist->getName() ?></h1>
            <button class="btn-artist-play" data-button="artist-play" onclick="playArtistPlaylist()">play</button>
        </div>
        <div class="artist-container__popular">
        <div class="tracklist-container">
            <h2 class="heading__secondary">Songs</h2>
                    <ul>
                        <?php 
                            $songIdArray = $artist->getSongIds();

                            $songCount = 1;

                            foreach($songIdArray as $songId) {

                                if ($songCount > 5) {
                                    break;
                                } 

                                $albumSong = new Song($dBConnection, $songId);
                                // RETURNS NEW ARTIST OBJECT
                                $songArtist = $albumSong->getArtist();
                                
                                echo "<li>
                                        <div class='tracklist-container__track-count'>
                                            <span class='tracklist-container__track-count--play' onClick='setTrack(\"" . $albumSong->getSongId() . "\", tempPlaylist, true)'><ion-icon name='play'></ion-icon></span>
                                            <span class='tracklist-container__track-count--count'>$songCount</span>
                                        </div>
                                        <div class='tracklist-container__track-info'>
                                            <div class='tracklist-container__track-title'>" . $albumSong->getSongTitle() . "</div>
                                            <div class='tracklist-container__track-artist'>" . $songArtist->getName() ."</div>
                                        </div>
                                        <button class='tracklist-container__track-options' data-song-id='" . $albumSong->getSongId() . "'onclick='showSongOptionsMenu(this)'><ion-icon name='ellipsis-horizontal'></ion-icon></button>
                                        <div class='tracklist-container__track-duration'>" . $albumSong->getDuration() . "</div>
                                    </li>";

                                $songCount += 1;
                            }
                        ?>
                       <script> 
                       
                       document.addEventListener("DOMContentLoaded", function(event) {let tempSongIds = '<?php echo json_encode($songIdArray); ?>'
                        console.log('asddjkshajdhajkshdkjhsjkahkjdhjksadhkjhdjksdhkajshdkjhaskjhdkjashdhajhdksjhdkjashdjhsajhdsahjdhakjshdkad')
                        console.log(tempSongIds + ' hsajdhksjhdjkashdkj')    
                        tempPlaylist = JSON.parse(tempSongIds);
                       })
                            
                        
</script>
                    </ul>
            </div>
            <nav class="options-menu" data-nav="options-menu" data-song-id="">
                    <div class="options-menu__items" onclick="selectPlaylist(this)" data-nav="options-item">Add to playlist</div>
                    <div class="options-menu__items">Item 2</div>
                    <div class="options-menu__items">Item 3</div>
            </nav>
        </div>
        <div class="artist-container__albums album-list__heading">
            <h2 class="heading__secondary artist-album__heading">Albums</h2>
        <?php 
include __DIR__ . '/../config.php'; 

    $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums WHERE artist='$artistId'");
    
    while($dbRow = mysqli_fetch_array($albumQuery)) {
        echo "<div class='album-card'>
                <span role='link' tabindex='0' onclick='openPage(\"includes/html/albumContent.php?id=" . $dbRow['id'] . "\")'>
                    <img class='album-image' src='" . $dbRow['artworkPath'] . "'>
                    <p class='album-title'>" . $dbRow['title'] . "</p>
                </span>
            </div>";
    }
?>
        </div>
</div>