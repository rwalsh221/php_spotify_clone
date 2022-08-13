<?php 
require( __DIR__ . '/../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
$data = json_decode($body, true);
if(isset($data) && $data['emailValue'] !== '') {
    
    $userEmail = $data['emailValue'];

    $username = $data['userLoggedIn'];
   
   
    if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo 'Email is invalid';
        exit();
    }

    $emailCheck = mysqli_query($dBConnection, "SELECT email FROM users WHERE email='$userEmail'");
    if(mysqli_num_rows(($emailCheck)) > 0) {
        echo 'Email is already in use';
        exit();
    }

    $updateQuery = mysqli_query($dBConnection, "UPDATE users SET email='$userEmail' WHERE userName='$username'");
    echo 'Email Successfully Updated';
   
} else {
    echo "Email is invalid";
}
?>