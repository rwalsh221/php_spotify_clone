<?php
require('../config.php');

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if(isset($data)) {
    $userName = $data['username'];
    $query = mysqli_query($dBConnection, "SELECT name, id FROM playlists WHERE owner='$userName'");
    
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

    echo json_encode($result);
}
?>