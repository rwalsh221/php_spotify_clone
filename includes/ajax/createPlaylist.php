<?php 
require( __DIR__ . '/../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
$data = json_decode($body, true);
// echo json_encode($data);
if(isset($data)) {
    // echo json_encode($name);
    $name = $data['name'];
    echo json_encode($name);

    $userName = $data['username'];
    echo json_encode($userName);

    $date = date("Y-m-d");
    echo json_encode($dBConnection);
    
    // echo json_encode($date);
    $query = mysqli_query($dBConnection, "INSERT INTO playlists VALUES (NULL, '$name', '$userName', '$date')");
} else {
    // echo "Name or Username ERROR";
    echo json_encode($body);
}
?>