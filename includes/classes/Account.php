<?php 

class Account {

    private $dBConnection;
    private $errorArray;

    public function __construct($dBConnection)
    {
        $this->dBConnection = $dBConnection;
        $this->errorArray = array();
    }

    public function register($registerUsername,
    $registerFirstName,
    $registerLastName,
    $registerEmail,
    $registerConfirmEmail,
    $registerPassword,
    $registerConfirmPassword) {
        $this->validateUserName($registerUsername);
        $this->validateFirstName($registerFirstName);
        $this->validateLastName($registerLastName);
        $this->validateEmail($registerEmail, $registerConfirmEmail);
        $this->validatePassword($registerPassword, $registerConfirmPassword);
        echo var_dump($this->errorArray);
        if(empty($this->errorArray)) {
            // insert into db
            return $this->insertUserDetails($registerUsername,
            $registerFirstName,
            $registerLastName,
            $registerEmail,
            $registerPassword);
        } else {
            return false;
        }
    }

    public function getError($error) {
        if(!in_array($error, $this->errorArray)) {
            $error = '';
        }
      
        return "<span class='error-message'>$error</span>";
    }

    private function insertUserDetails($registerUsername,
    $registerFirstName,
    $registerLastName,
    $registerEmail,
    $registerPassword) {
        $encryptedPassword = md5($registerPassword);
        $profilePicture = "assets/images/profilePics/head_emerald.png";
        $date = date("Y-m-d");

        $result = mysqli_query($this->dBConnection, "INSERT INTO users VALUES (NULL, '$registerUsername',
        '$registerFirstName',
        '$registerLastName',
        '$registerEmail', '$encryptedPassword', '$date', '$profilePicture')");

        echo "Error: " . mysqli_error($this->dBConnection);
        return $result;

    }

    

    // VALIDATE FORM INPUT
    private function validateUserName($username) {
       if(strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errorArray, Constants::$userNameLengthError);
            return;
        } 
        
        // TODO: check if username exists
       
    }

    private function validateFirstName($firstName) {
        if(strlen($firstName) > 25 || strlen($firstName) < 2) {
            array_push($this->errorArray, Constants::$firstNameLengthError);
            return;
        } 
    }

    private function validateLastName($lastName) {
        if(strlen($lastName) > 25 || strlen($lastName) < 2) {
            array_push($this->errorArray, Constants::$lastNameLengthError);
            return;
        } 
    }

    private function validateEmail($email, $confirmEmail) {
        if($email != $confirmEmail) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        // TODO: check that email is already been used
    }

    private function validatePassword($password, $confirmPassword) {
        if($password != $confirmPassword) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }

        // REG EXPRESSION. ^ = not. if string is not number and letters
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
            return;
        }

        if(strlen($password) > 30 || strlen($confirmPassword) < 5) {
            array_push($this->errorArray, Constants::$passwordLengthError);
            return;
        } 
    }
}
?>