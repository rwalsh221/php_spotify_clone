<?php
// LOGIN BUTTON PRESSED
if(isset($_POST['login-button'])) {
   $loginUsername = $_POST['login-username'];
   $loginPassword = $_POST['login-password'];
}

$result = $account->login($loginUsername, $loginPassword);

if($result) {
    $_SESSION['userLoggedIn'] = $loginUsername;
    header("Location: index.php");
}

?>