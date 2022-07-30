<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/Artist.php';
include __DIR__ . '/../classes/Album.php';
include __DIR__ . '/../classes/Song.php';

// MANUAL LOGOUT
// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

?>

<div class="playlist-content album-list">
    <h1 class="heading-primary album-list__heading">PLAYLISTS</h1>
    <div class="playlist-container__btn">
        <button class="playlist-btn__new" onclick="createPlaylist()">NEW PLAYLIST</button>
    </div>
</div>