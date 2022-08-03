<?php 
require( __DIR__ . '/../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
$data = json_decode($body, true);
// echo json_encode($data);
if(isset($data)) {
    // echo json_encode($name);
    $playlistId = $data['playlistId'];

    $playListQuery = mysqli_query($dBConnection, "DELETE FROM playlists WHERE id='$playlistId'");
    $songsQuery = mysqli_query($dBConnection, "DELETE FROM playlistSongs WHERE playlistId='$playlistId'");

    
    // echo json_encode($date);
    $query = mysqli_query($dBConnection, "INSERT INTO playlists VALUES (NULL, '$name', '$userName', '$date')");
} 
?>