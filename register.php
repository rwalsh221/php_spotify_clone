<?php 
require("includes/config.php");
require("includes/classes/Account.php");
require("includes/classes/Constants.php");

$account = new Account($dBConnection);

require("includes/handlers/registerHandler.php");
require("includes/handlers/loginHandler.php");

function getFormFieldValue($name) {
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <script src="assets/javascript/register.js" defer></script> 
    <title>Welcome to Slotify</title>
</head>
<body>
    <section class="main">
        <div class='content-wrapper'>
            <div class="form-container">
                <!-- LOGIN FORM -->
                    <form id="login-form" action="register.php" method="post" data-form="login" class="fade-in">
                        <h2 class="heading__secondary--register">Login to your account</h2>
                        <div>
                            <?php echo $account->getError(Constants::$loginFailed); ?> 
                            <label for="login-username">Username</label>
                            <input type="text" name="login-username" id="login-username" placeholder="username" value="<?php getFormFieldValue('login-username') ?>" required>
                        </div>
                        <div>
                            <label for="login-password">Password</label>
                            <input type="password" name="login-password" id="login-password" required>
                        </div>

                        <button type="submit" name="login-button" class="register-button">Log in</button>

                        <div class="has-account">
                            <p data-register="show">Dont have an account? Sign up here</p>
                        </div>

                    </form>
                <!-- REGISTER FORM -->
                    <form id="register-form" class="register-form fade-in" action="register.php" method="post" data-form="register">
                        <h2 class="heading__secondary--register">Create your account</h2>
                        <div>
                            <?php echo $account->getError(Constants::$userNameLengthError); ?>
                            <?php echo $account->getError(Constants::$usernameTaken); ?>
                            <label for="register-username">Username</label>
                            <input type="text" name="register-username" id="register-username" placeholder="Username" value="<?php getFormFieldValue('register-username') ?>" required>
                        </div>
                        <div>
                            <?php echo $account->getError(Constants::$firstNameLengthError); ?>
                            <label for="register-firstname">First Name</label>
                            <input type="text" name="register-firstname" id="register-firstname" placeholder="First Name" value="<?php getFormFieldValue('register-firstname') ?>" required>
                        </div>
                        <div> 
                            <?php echo $account->getError(Constants::$lastNameLengthError); ?>
                            <label for="register-lastname">Last Name</label>
                            <input type="text" name="register-lastname" id="register-lastname" placeholder="Last Name" value="<?php getFormFieldValue('register-lastname') ?>" required>
                        </div>
                        <div>                
                            <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                            <?php echo $account->getError(Constants::$emailInvalid); ?>
                            <?php echo $account->getError(Constants::$emailTaken); ?>
                            <label for="register-email">Email</label>
                            <input type="email" name="register-email" id="register-email" placeholder="Email" value="<?php getFormFieldValue('register-email') ?>" required>
                        </div>
                        <div> 
                            <label for="register-confirm-email">Confirm Email</label>
                            <input type="email" name="register-confirm-email" id="register-confirm-email" placeholder="Confirm Email" value="<?php getFormFieldValue('register-confirm-email') ?>" required>
                        </div>
                        <div>
                            <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                            <?php echo $account->getError(Constants::$passwordNotAlphaNumeric); ?>
                            <?php echo $account->getError(Constants::$passwordLengthError); ?>
                            <label for="register-password">Password</label>
                            <input type="password" name="register-password" id="register-password" value="<?php getFormFieldValue('register-password') ?>" required>
                        </div>
                        <div>
                            <label for="register-confirm-password">Confirm Password</label>
                            <input type="password" name="register-confirm-password" id="register-confirm-password" value="<?php getFormFieldValue('register-confirm-password') ?>" required>
                        </div>
                        
                        <button type="submit" name="register-button" class="register-button">Sign Up</button>

                        <div class="has-account">
                            <p data-register="hide">Already have an account? Log in here</p>
                        </div>
                    </form>
                
            </div>

            <div class="content-container">
                <h1 class="heading__primary">Get great music,<br> right now</h1>
                <p>Listen to loads of songs for free</p>
                <ul>
                    <li><ion-icon class="icon" name="checkmark-outline"></ion-icon>&nbsp;<span>Music you'll fall in love with</span></li>
                    <li><ion-icon class="icon" name="checkmark-outline"></ion-icon>&nbsp;<span>Create your own playlists</span></li>
                    <li><ion-icon class="icon" name="checkmark-outline"></ion-icon>&nbsp;<span>Follow artists and keep up to date</span></li>
                </ul>
            </div>
        </div>
    </section>
    
    <?php 
    if(isset($_POST['register-button'])) {
        echo '<script>
                document.querySelector("[data-form=\"register\"]").style.display = "block"
                document.querySelector("[data-form=\"login\"]").style.display = "none"
            </script>';
    } else {
        echo '<script>
                document.querySelector("[data-form=\"login\"]").style.display = "block"
                document.querySelector("[data-form=\"register\"]").style.display = "none"
            </script>';
    }
    ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>