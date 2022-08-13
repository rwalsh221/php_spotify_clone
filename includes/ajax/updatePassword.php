<?php 
require( __DIR__ . '/../config.php');

// GET JSON SENT FROM JAVASCRIPT
$body = file_get_contents('php://input');
$data = json_decode($body, true);
if(isset($data) && $data['newPasswordValue'] || $data['confirmPasswordValue'] !== '') {
    
    $username = $data['userLoggedIn'];
    $currentPassword = $data['oldPasswordValue'];
    $newPassword = $data['newPasswordValue'];
    $confirmNewPassword = $data['confirmPasswordValue'];

    $currentPasswordMd5 = md5($currentPassword);
    $passwordCheck = mysqli_query($dBConnection, "SELECT * FROM users WHERE userName='$username' AND password='$currentPasswordMd5'");
    if (mysqli_num_rows($passwordCheck) != 1) {
        echo 'Password is incorrect';
        exit();
    }

    if ($newPassword != $confirmNewPassword) {
        echo 'Your new passwords do not match';
        exit();
    }

    if (preg_match('/[^A-Za-z9-0]/', $newPassword)) {
        echo 'Your must contain only letters and numbers';
        exit();
    }

    if (strlen($newPassword) > 30 || strlen($newPassword) < 5) {
        echo 'Your password must be between 5 and 30 characters';
        exit();
    }
   
   
    $newPasswordMd5 = md5($newPassword);

    $query = mysqli_query($dBConnection, "UPDATE users SET password='$newPasswordMd5' WHERE userName='$username'");
   
    echo 'Password update succesfull';
} else {
    echo "Password is invalid";
}
?>