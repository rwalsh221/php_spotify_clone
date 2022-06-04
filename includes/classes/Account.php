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
            array_push($this->errorArray, "Your Username must be between 5 and 25 characters");
            return;
        } 
        
        // TODO: check if username exists
       
    }

    private function validateFirstName($firstName) {
        if(strlen($firstName) > 25 || strlen($firstName) < 2) {
            array_push($this->errorArray, "Your first name must be between 2 and 25 characters");
            return;
        } 
    }

    private function validateLastName($lastName) {
        if(strlen($lastName) > 25 || strlen($lastName) < 2) {
            array_push($this->errorArray, "Your last name must be between 2 and 25 characters");
            return;
        } 
    }

    private function validateEmail($email, $confirmEmail) {
        if($email != $confirmEmail) {
            array_push($this->errorArray, 'Your Emails do not match');
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, 'Email is invalid');
            return;
        }

        // TODO: check that email is already been used
    }

    private function validatePassword($password, $confirmPassword) {
        if($password != $confirmPassword) {
            array_push($this->errorArray, 'Your Passwords do not match');
            return;
        }

        // REG EXPRESSION. ^ = not. if string is not number and letters
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, 'Your Passwords can only contain number and letters');
            return;
        }

        if(strlen($password) > 30 || strlen($confirmPassword) < 5) {
            array_push($this->errorArray, "Your password must be between 5 and 30 characters");
            return;
        } 
    }
}
?>