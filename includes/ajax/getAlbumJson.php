<?php
require('../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
// CHANGE BODY FROM JSON INTO PHP ARRAY
$data = json_decode($body, true);


if (isset($data)) {

    $albumId = $data['albumId'];

    $query = mysqli_query($dBConnection, "SELECT * FROM albums WHERE id='$albumId'");

    $resultArray = mysqli_fetch_assoc($query);


   echo json_encode($resultArray);
}



?>