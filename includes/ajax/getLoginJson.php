<?php
require('../config.php');

if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
        echo json_encode($userLoggedIn);
    }

?>