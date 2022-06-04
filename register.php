<?php 
require("includes/classes/Account.php");

$account = new Account();

require("includes/handlers/registerHandler.php");
require("includes/handlers/loginHandler.php");

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
            <div>
                <?php echo $account->getError("Your Username must be between 5 and 25 characters"); ?>
                <label for="register-username">Username</label>
                <input type="text" name="register-username" id="register-username" placeholder="Username" required>
            </div>
            <div>
                <?php echo $account->getError("Your first name must be between 2 and 25 characters"); ?>
                <label for="register-firstname">First Name</label>
                <input type="text" name="register-firstname" id="register-firstname" placeholder="First Name" required>
            </div>
            <div> 
                <?php echo $account->getError("Your last name must be between 2 and 25 characters"); ?>
                <label for="register-lastname">Last Name</label>
                <input type="text" name="register-lastname" id="register-lastname" placeholder="Last Name" required>
            </div>
            <div>                
                <?php echo $account->getError("Your Emails do not match"); ?>
                <?php echo $account->getError("Email is invalid"); ?>
                <label for="register-email">Email</label>
                <input type="email" name="register-email" id="register-email" placeholder="Email" required>
            </div>
            <div> 
                <label for="register-confirm-email">Confirm Email</label>
                <input type="email" name="register-confirm-email" id="register-confirm-email" placeholder="Confirm Email" required>
            </div>
            <div>
                <?php echo $account->getError("Your Passwords do not match"); ?>
                <?php echo $account->getError("Your Passwords can only contain number and letters"); ?>
                <?php echo $account->getError("Your password must be between 5 and 30 characters"); ?>
                <label for="register-password">Password</label>
                <input type="password" name="register-password" id="register-password" required>
            </div>
            <div>
                <label for="register-confirm-password">Confirm Password</label>
                <input type="password" name="register-confirm-password" id="register-confirm-password" required>
            </div>
            
            <button type="submit" name="register-button">Sign Up</button>
        </form>
    </div>
</body>
</html>