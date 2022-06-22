<?php

// SANITIZE FORM FUNCTIONS
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

    $registerSuccess = 
    $account->register($registerUsername,
    $registerFirstName,
    $registerLastName,
    $registerEmail,
    $registerConfirmEmail,
    $registerPassword,
    $registerConfirmPassword);

    if($registerSuccess) {
        $_SESSION['userLoggedIn'] = $registerUsername;
        header("Location: index.php");
    }
    

} 
?>