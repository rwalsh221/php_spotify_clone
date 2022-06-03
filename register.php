<?php

function sanitizeFormUsername($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    
    return $inputText;
}

function sanitizeFormString($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));

    return $inputText;
}

function sanitizeFormPassword($inputText) {
    $inputText = strip_tags($inputText);

    return $inputText;
}

if(isset($_POST['login-button'])) {
    //login button pressed
}

if (isset($_POST['register-button'])) {
    // register button pressed
    $registerUsername = sanitizeFormUsername($_POST['register-username']);

    $registerFirstName = sanitizeFormString($_POST['register-firstname']);
    $registerLastName = sanitizeFormString($_POST['register-lastname']);
    $registerEmail = sanitizeFormString($_POST['register-email']);
    $registerConfirmEmail = sanitizeFormString($_POST['register-confirm-email']);
    
    $registerPassword = sanitizeFormPassword($_POST['register-password']);
    $registerConfirmPassword = sanitizeFormPassword($_POST['register-confirm-password']);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Slotify</title>
</head>
<body>
    <!-- LOGIN FORM -->
    <div id="inputContainer">
        <form id="login-form" action="register.php" method="post">
            <h2>Login to your account</h2>
            <label for="login-username">Username</label>
            <input type="text" name="login-username" id="login-username" placeholder="username" required><br>
            <label for="login-password">Password</label>
            <input type="password" name="login-password" id="login-password" required><br>

            <button type="submit" name="login-button">Login</button>
        </form>
    <!-- REGISTER FORM -->
        <form id="register-form" action="register.php" method="post">
            <h2>Create your account</h2>
            <label for="register-username">Username</label>
            <input type="text" name="register-username" id="register-username" placeholder="Username" required><br>
            
            <label for="register-firstname">First Name</label>
            <input type="text" name="register-firstname" id="register-firstname" placeholder="First Name" required><br>
            
            <label for="register-lastname">Last Name</label>
            <input type="text" name="register-lastname" id="register-lastname" placeholder="Last Name" required><br>
            
            <label for="register-email">Email</label>
            <input type="email" name="register-email" id="register-email" placeholder="Email" required><br>

            <label for="register-confirm-email">Confirm Email</label>
            <input type="email" name="register-confirm-email" id="register-confirm-email" placeholder="Confirm Email" required><br>

            <label for="register-password">Password</label>
            <input type="password" name="register-password" id="register-password" required><br>

            <label for="register-confirm-password">Confirm Password</label>
            <input type="password" name="register-confirm-password" id="register-confirm-password" required><br>

            <button type="submit" name="register-button">Sign Up</button>
        </form>
    </div>
</body>
</html>