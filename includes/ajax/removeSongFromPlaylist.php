<?php 
require( __DIR__ . '/../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
$data = json_decode($body, true);

if(isset($data)) {
    // echo json_encode($data);
    $songId = $data['songId'];
    $playlistId = $data['playlistId'];

    $query = mysqli_query($dBConnection, "DELETE FROM playlistSongs WHERE playlistId='$playlistId' AND songId='$songId'");
    



} else {
    echo "id or playlist ERROR";
    // echo json_encode($body);
}
?>