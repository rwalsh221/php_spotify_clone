<?php
require('../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
// CHANGE BODY FROM JSON INTO PHP ARRAY
$data = json_decode($body, true);


if (isset($data)) {

    $artistId = $data['artistId'];

    $query = mysqli_query($dBConnection, "SELECT * FROM artists WHERE id='$artistId'");

    $resultArray = mysqli_fetch_assoc($query);


   echo json_encode($resultArray);
}



?>