<?php
require('../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
// CHANGE BODY FROM JSON INTO PHP ARRAY
$data = json_decode($body, true);


if (isset($data)) {

    $songId = $data['songId'];

    $query = mysqli_query($dBConnection, "UPDATE songs SET plays = plays + 1 WHERE id='$songId'");

    $query = mysqli_query($dBConnection, "SELECT * FROM songs WHERE id='$songId'");

    $resultArray = mysqli_fetch_assoc($query);


 echo "Error: " . mysqli_error($dBConnection);

}



?>