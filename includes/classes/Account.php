<?php 

class Account {

    private $errorArray;

    public function __construct()
    {
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
    
        if(empty($this->errorArray)) {
            // insert into db
            return true;
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