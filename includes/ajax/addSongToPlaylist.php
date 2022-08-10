<?php 
require( __DIR__ . '/../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
$data = json_decode($body, true);

if(isset($data)) {
    // echo json_encode($data);
    $songId = $data['songId'];
    
    $playlistId = $data['playlistId'];

    $playlistOrderQuery = mysqli_query($dBConnection, "SELECT IFNULL(MAX(playlistOrder) + 1, 1) as playlistOrder FROM playlistSongs WHERE playlistId='$playlistId'");
    $row = mysqli_fetch_array($playlistOrderQuery);
    $order = $row['playlistOrder'];
    echo json_encode($order);
    $query = mysqli_query($dBConnection, "INSERT INTO playlistSongs VALUES(null, '$songId', '$playlistId', '$order')");



} else {
    echo "id or playlist ERROR";
    // echo json_encode($body);
}
?>