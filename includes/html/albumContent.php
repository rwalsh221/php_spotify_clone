<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/Artist.php';
include __DIR__ . '/../classes/Album.php';
include __DIR__ . '/../classes/Song.php';

// CHECK FOR ALBUM ID ON URL AND GET FROM DB
if (isset($_GET['id'])) {
    $albumId = $_GET['id'];
    $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums WHERE id='$albumId'");
    $album = mysqli_fetch_array($albumQuery);

    $album = new Album($dBConnection, $albumId);
    $artist = $album->getArtist();
    echo $albumId;
    } else {
    // header("Location: index.php");
    echo 'NO ID';
}
?>


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
                <div class="tracklist-container" data-container="tracklist">
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
                        console.log(tempPlaylist)})
                            
                        
</script>
                    </ul>
                </div>
                        <!-- ADD HTML TO SHOWSONGOPTIONSMENU. INSERT ADJACENTE HTML. SO CAN GET SONG ID FROM tracklist-conatiner__track-options. -->
                <nav class="options-menu" data-nav="options-menu" data-song-id="">
                    <div class="options-menu__items" onclick="selectPlaylist(this)" data-nav="options-item">Add to playlist</div>
                    <div class="options-menu__items">Item 2</div>
                    <div class="options-menu__items">Item 3</div>
                </nav>