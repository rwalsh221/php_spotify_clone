<?php
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/Artist.php';
include __DIR__ . '/../classes/Album.php';
include __DIR__ . '/../classes/Song.php';


if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
    echo 'term';
} else {
    echo 'no term';
    $term = '';
}


?>

<div class="search-content">
    <div class="search-container">
        <h1 class="search-heading">Search for a artist, album or song</h1>
        <input autofocus onkeyup="searchHandler(this)" type="text" class="search-input" data-search="input" onfocus="this.setSelectionRange(this.value.length,this.value.length);" value="<?php echo $term; ?>" placeholder="Search Here...">
    </div>
    
</div>
<div class="tracklist-container">
            <h2 class="heading__secondary">Songs</h2>
                    <ul>
                        <?php 
                            $songQuery = mysqli_query($dBConnection, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

                            if(mysqli_num_rows($songQuery) === 0) {
                                echo "<span>No songs found matching " . $term . "</span>";
                            }

                            $songIdArray = array();

                            $songCount = 1;

                            while($row = mysqli_fetch_array($songQuery)) {

                                if ($songCount > 15) {
                                    break;
                                } 
                                
                                array_push($songIdArray, $row['id']);

                                $albumSong = new Song($dBConnection, $row['id']);
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
                       console.log('hello search')
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

<div class="artist-container">
    <h2>Artists</h2>

    <?php 
    echo __dir__;
    $artistsQuery = mysqli_query($dBConnection, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");
    
    if(mysqli_num_rows($artistsQuery) === 0) {
        echo "<span>No artists found matching " . $term . "</span>";
    }

    while($row = mysqli_fetch_array($artistsQuery)) {
        $artistFound = new Artist($dBConnection, $row['id']);

        echo "<div>
                <span>
                    <span role='link' tabindex='0' onclick='openPage(\"includes/html/artistContent.php?id=" . $artistFound->getId() ."\")'>
                        " . $artistFound->getName() . "
                    </span>
                </span>
            </div>";
    }
    
    ?>
</div>

<div class="artist-container__albums album-list__heading">
            <h2 class="heading__secondary artist-album__heading">Albums</h2>
        <?php 
        include __DIR__ . '/../config.php'; 

        $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");
    
        if(mysqli_num_rows($albumQuery) === 0) {
            echo "<span>No albums found matching " . $term . "</span>";
        }

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

