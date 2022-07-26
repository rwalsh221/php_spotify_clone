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
    <div>
        <div>
            <h1><?php echo $artist->getName() ?></h1>
        </div>
    </div>
</div>