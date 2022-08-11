<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/User.php';

// MANUAL LOGOUT
// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

if (isset($_GET['userLoggedIn'])) {
    $user = new User($dBConnection, $_GET['userLoggedIn']); 
} else {
    header("Location: register.php");
}

?>

<div class="user-container">
    <h1 class="heading__primary"><?php echo $user->getFirstNameLastName() ?></h1>
    <button class="btn__primary" onclick="openPage('includes/html/updateUserDetails.php')">User Details</button>
    <button class="btn__primary" onclick="logout()">Logout</button>
</div>