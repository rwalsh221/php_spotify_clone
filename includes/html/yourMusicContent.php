<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/Artist.php';
include __DIR__ . '/../classes/Album.php';
include __DIR__ . '/../classes/Playlist.php';
include __DIR__ . '/../classes/User.php';

// MANUAL LOGOUT
// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

if (isset($_GET['userLoggedIn'])) {
    $userLoggedIn = new User($dBConnection, $_GET['userLoggedIn']); 
} else {
    header("Location: register.php");
}



?>

<div class="playlist-content album-list">
    <h1 class="heading-primary album-list__heading">PLAYLISTS</h1>
    <div class="playlist-container__btn">
        <button class="playlist-btn__new" onclick="createPlaylist()">NEW PLAYLIST</button>
    </div>
    
        <?php 
        $username = $userLoggedIn->getUsername();
        $playlistsQuery = mysqli_query($dBConnection, "SELECT * FROM playlists WHERE owner='$username'");
    
        if(mysqli_num_rows($playlistsQuery) === 0) {
            echo "<span>no playlists found</span>";
        }

        while($dbRow = mysqli_fetch_array($playlistsQuery)) {
            // var_dump($row);
            $playlist = new Playlist($dBConnection, $dbRow);
            echo "<div class='playlist-card' role='link' tabindex='' 
                        onclick='openPage(\"/includes/html/playlistContent.php?id=" . $playlist->getPlaylistId() ."\")'>
                <div>
                    <img src='assets/images/playlist.jpg'>
                </div> 
                <div>
                    <p class='playlist-title'>" . $playlist->getPlaylistName() . "</p>
                </div>
            </div>";
    }
        ?>


</div>