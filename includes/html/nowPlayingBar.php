<?php 
    $songQuery = mysqli_query($dBConnection, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();
    
    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);
    var_dump($jsonArray);
?>

<script>
    const setTrack = (trackId, newPlaylist, play) => {

    }

    document.addEventListener("DOMContentLoaded", function(event) {
    currentPlaylist = <?php echo $jsonArray ?>;
    console.log(currentPlaylist)
    audioElement = new Audio();
    
    setTrack(currentPlaylist[0], currentPlaylist, false)
});
</script>

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