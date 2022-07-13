<?php
require('../config.php');

$body = file_get_contents('php://input');
// CHANGE BODY FROM JSON INTO PHP ARRAY
$data = json_decode($body, true);


if (isset($data)) {

    $songId = $data['songId'];

    $query = mysqli_query($dBConnection, "SELECT * FROM songs WHERE id='$songId'");

    $resultArray = mysqli_fetch_array($query);


   echo json_encode($resultArray);
}



?>