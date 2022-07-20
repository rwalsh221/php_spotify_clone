<?php 
    $songQuery = mysqli_query($dBConnection, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();
    
    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);
   
?>

<script>
    const nextSong = () => {
        const test = !audioElement.audioHtmlElement.paused
        console.log(test)
        if(currentPlaylistIndex === currentPlaylist.length - 1) {
            currentPlaylistIndex = 0
        } else {
            currentPlaylistIndex += 1
        }

        
            setTrack(currentPlaylist[currentPlaylistIndex], currentPlaylist, !audioElement.audioHtmlElement.paused)

        
    }

    // const prevSong 

    const getSongAjax = async (trackId) => {
        
        try {
            // const data = {
            //     songId: trackId
            // }

            const song = await fetch('includes/ajax/getSongJson.php', {
                method: 'POST',
                body: JSON.stringify({songId: trackId}),
            })

            const songJson = await song.json()

            

            const artist = await fetch('includes/ajax/getArtistJson.php', {
                method: 'POST',
                body: JSON.stringify({artistId: songJson.artist}),
            })

            

            const artistJson = await artist.json();

           

            const album = await fetch('includes/ajax/getAlbumJson.php', {
                method: 'POST',
                body: JSON.stringify({albumId: songJson.album}),
            })

            

            const albumJson = await album.json();

            console.log(albumJson)

            document.querySelector('[data-nowPlaying="song-title"]').textContent = songJson.title;
            document.querySelector('[data-nowPlaying="song-artist"]').textContent = artistJson.name;
            document.querySelector('[data-nowPlaying="song-album-art"]').src = albumJson.artworkPath;
            console.log(audioElement)
            audioElement.setTrack(songJson);
            
        
        } catch {

        }

    }

    const setTrack = async (trackId, newPlaylist, play) => {
        currentPlaylistIndex = currentPlaylist.indexOf(trackId)
        try {

            await getSongAjax(trackId)
            
            if(play) {
            audioElement.playSong()
            }

        } catch (error) {
            console.error(error)
        }
        
        
    } 

    const playSong = () => {
        // audioHtmlElement from Audio class
        if (audioElement.audioHtmlElement.currentTime === 0) {
            updateSongPlayCount()
        } 

        document.querySelector('[data-button="pause"]').style.display = 'block'
        document.querySelector('[data-button="play"]').style.display = 'none'
        audioElement.playSong()
    }

    const pauseSong = () => {
        document.querySelector('[data-button="pause"]').style.display = 'none'
        document.querySelector('[data-button="play"]').style.display = 'block'
        audioElement.pauseSong()
    }

    const updateSongPlayCount = async () => {
        try {
            const song = await fetch('includes/ajax/updatePlays.php', {
                method: 'POST',
                body: JSON.stringify({songId: audioElement.currentlyPlaying.id}),
            })

        } catch (error) {
            console.error('song play not updated', error)
        }
        
    }

    const getElementWidth = (htmlElement) => {
        // get computed style gets styles from css stylesheet. event.target.style only returns inline styles
        const elementWidth = window.getComputedStyle(htmlElement).width // example = 125px
        const pxLocation = elementWidth.search('p') // find location of px in string
        return elementWidth.substr(0, pxLocation - 1) // remove px
    }

    const progressBarDrag = (mouseEvent, progressBar) => {
        const progressBarWidth = getElementWidth(progressBar)
        
        const percentage = mouseEvent.offsetX / progressBarWidth * 100;
        const seconds = audioElement.audioHtmlElement.duration * (percentage / 100);
        
        audioElement.setTime(seconds)
    }

    const volumeBarDrag = (mouseEvent, volumeBar) => {

    }

    // EVENET LISTNER WHEN PAGE IS LOADED
    document.addEventListener("DOMContentLoaded", function(event) {
        currentPlaylist = <?php echo $jsonArray ?>;
        audioElement = new Audio();
        
        setTrack(currentPlaylist[0], currentPlaylist, false)

        const progressBarHtml = document.querySelector('[data-nowPlaying="progress-bar"]')
        const volumeBarHtml = document.querySelector('[data-nowPlaying="volume-bar"]')
        const nowPlayingContainerHtml = document.querySelector('[data-nowPlaying="now-playing-container"]')

        nowPlayingContainerHtml.addEventListener('mousedown', (event) => {
            event.preventDefault()
        })

        nowPlayingContainerHtml.addEventListener('touchstart', (event) => {
            event.preventDefault()
        })

        nowPlayingContainerHtml.addEventListener('mousemove', (event) => {
            event.preventDefault()
        })

        nowPlayingContainerHtml.addEventListener('touchmove', (event) => {
            event.preventDefault()
        })

        progressBarHtml.addEventListener('mousedown', (event) => {
            mouseDown = true;
            progressBarDrag(event, progressBarHtml)
        })

        progressBarHtml.addEventListener('mousemove', (event) => {
            if(mouseDown === true) {
                progressBarDrag(event, progressBarHtml)
            }
        })

        progressBarHtml.addEventListener('mouseup', (event) => {
           progressBarDrag(event, progressBarHtml)
        })

        volumeBarHtml.addEventListener('mousedown', (event) => {
            mouseDown = true;
            // progressBarDrag(event, volumeBarHtml)
        })

        volumeBarHtml.addEventListener('mousemove', (event) => {
            if(mouseDown === true) {
                volume = event.offsetX / getElementWidth(volumeBarHtml);  

                if (volume >= 0 && volume <= 1) {
                    audioElement.audioHtmlElement.volume = volume
                }
            }
        })

        volumeBarHtml.addEventListener('mouseup', (event) => {
            if(mouseDown === true) {
                volume = event.offsetX / getElementWidth(volumeBarHtml);  

                if (volume >= 0 && volume <= 1) {
                    audioElement.audioHtmlElement.volume = volume
                }
            }
        })

        window.addEventListener('mouseup', () => {
            if(mouseDown === true) { mouseDown = false }
        })
        
        audioElement.updateVolumeProgressBar(audioElement.audioHtmlElement)
    });
</script>

<div class="now-playing-bar" data-nowPlaying="now-playing-container">
    <div class="now-playing-bar__left">
        <div class="now-playing__img">
            <img data-nowPlaying="song-album-art" src="" alt="now playing">
        </div>
        <div class="now-playing__info">
            <p class="now-playing__song-title" data-nowPlaying="song-title"></p>
            <p class="now-playing__song-artist" data-nowPlaying="song-artist"></p>
        </div>
    </div>
    <div class="now-playing-bar__center">
        <div class="now-playing-bar__controls">
            <button class="now-playing-bar__button" title="Shuffle"><ion-icon name="shuffle-outline"></ion-icon></ion-icon></button>
            <button class="now-playing-bar__button" title="Skip back"><ion-icon name="play-skip-back"></ion-icon></button>
            <button class="now-playing-bar__button button-play" data-button='play' title="Play" onclick="playSong()"><ion-icon name="play-circle-outline"></ion-icon></button>
            <button class="now-playing-bar__button button-pause" data-button='pause' title="Pause" onclick="pauseSong()"><ion-icon name="pause-circle-outline"></ion-icon></button>
            <button class="now-playing-bar__button" title="Skip forward" onclick="nextSong()"><ion-icon name="play-skip-forward"></ion-icon></button>
            <button class="now-playing-bar__button" title="Repeat"><ion-icon name="repeat-outline"></ion-icon></button>
        </div>
        <div class="now-playing-bar__progress-bar">
            <span class="progress-time current" data-nowPlaying="progress-time-curr">0.00</span>
            <div class="progress-bar">
                <div class="progress-bar__background" data-nowPlaying="progress-bar">
                    <div class="progress-bar__foreground" data-nowPlaying="progress-bar-foreground"></div>
                </div>
            </div>
            <span class="progress-time remaining" data-nowPlaying="progress-time-rem"></span>
        </div>
    </div>
    <div class="now-playing-bar__right">
        <button class="now-playing-bar__button"><ion-icon name="volume-medium-outline"></ion-icon></button>
        <div class="now-playing__volume-bar" data-nowPlaying="volume-bar">
            <div class="volume-bar__background">
                <div class="volume-bar__foreground" data-nowPlaying="volume-bar-foreground"></div>
            </div>
        </div>
    </div>
</div>