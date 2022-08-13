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

<div class="update-user-form-container">
    <h1 class="heading__primary">Update Your Details</h1>
    <div class="update-user-email">
        <h2 class="heading__secondary">EMAIL</h2>
        <input autocomplete="off" data-update-user="email" type="email" id="update-email" name="update-email" placeholder="Email Address..." value="<?php echo $user->getUserEmail() ?>">
        <p class="error-message" data-update-user="email-message"></p>
        <button class="btn__primary btn__update-user" onclick="updateEmail()">UPDATE</button>
    </div>
    <div class="update-user-password">
        <h2 class="heading__secondary">PASSWORD</h2>
        <input autocomplete="off" data-update-user="pw-old" type="password" id="current-password" name="current-password" placeholder="Current Password">
        <input autocomplete="off" data-update-user="pw-new" type="password" id="update-password" name="update-password" placeholder="New Password">
        <input autocomplete="off" data-update-user="confirm-pw-new" type="password" id="confirm-update-password" name="confirm-update-password" placeholder="Confirm New Password">
        <p class="error-message" data-update-user="password-message"></p>
        <button class="btn__primary btn__update-user" onclick="updatePassword()">UPDATE</button>
    </div>
</div>