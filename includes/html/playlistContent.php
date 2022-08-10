<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/Artist.php';
include __DIR__ . '/../classes/Album.php';
include __DIR__ . '/../classes/Song.php';
include __DIR__ . '/../classes/Playlist.php';
include __DIR__ . '/../classes/User.php';



// CHECK FOR ALBUM ID ON URL AND GET FROM DB
if (isset($_GET['id'])) {
    $playlistId = $_GET['id'];

    $playlist = new Playlist($dBConnection, $playlistId);
    $owner = new User($dBConnection, $playlist->getPlaylistOwner());

    } else {
    header("Location: index.php");
}
?>


<div class="album-container">
                    <div class="album-container__img">
                        <img src="assets/images/playlist.jpg">
                    </div>
                    <div class="album-container__info">
                        <h1><?php echo $playlist->getPlaylistName(); ?></h1>
                        <p class="album-container-info--artist"><?php echo 'by ' . $playlist->getPlaylistOwner(); ?></p>
                        <p class="album-container-info--songs"><?php echo $playlist->getNumberOfSongs() . ' songs' ?></p>
                        <button class="playlist-btn-delete" data-btn="playlist-delete" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>
                    </div>
                </div>
                <div class="tracklist-container">
                    <ul>
                        <?php 
                            $songIdArray = $playlist->getPlaylistSongIds();
                            $songCount = 1;

                            foreach($songIdArray as $songId) {
                                $playlistSong = new Song($dBConnection, $songId);
                                // RETURNS NEW ARTIST OBJECT
                                $songArtist = $playlistSong->getArtist();
                                
                                echo "<li>
                                        <div class='tracklist-container__track-count'>
                                            <span class='tracklist-container__track-count--play' onClick='setTrack(\"" . $playlistSong->getSongId() . "\", tempPlaylist, true)'><ion-icon name='play'></ion-icon></span>
                                            <span class='tracklist-container__track-count--count'>$songCount</span>
                                        </div>
                                        <div class='tracklist-container__track-info'>
                                            <div class='tracklist-container__track-title'>" . $playlistSong->getSongTitle() . "</div>
                                            <div class='tracklist-container__track-artist'>" . $songArtist->getName() ."</div>
                                        </div>
                                        <button class='tracklist-container__track-options' data-song-id='" . $playlistSong->getSongId() . "'onclick='showSongOptionsMenu(this)'><ion-icon name='ellipsis-horizontal'></ion-icon></button>
                                        <div class='tracklist-container__track-duration'>" . $playlistSong->getDuration() . "</div>
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
                <nav class="options-menu" data-nav="options-menu" data-playlist-options="true" data-song-id="" data-playlist-id="<?php echo $playlistId; ?>">
                    <div class="options-menu__items" onclick="selectPlaylist(this)" data-nav="options-item">Add to playlist</div>
                    <div class="options-menu__items"  onclick="removeSongFromPlaylist(this)" data-nav="options-item">Remove From Playlist</div>
                    <div class="options-menu__items">Item 3</div>
                </nav>
                