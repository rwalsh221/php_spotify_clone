<?php 
class User {

    private $dBConnection;
    private $username;

    public function __construct($dBConnection, $username)
    {
        $this->dBConnection = $dBConnection;
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getFirstNameLastName() {
        $query = mysqli_query($this->dBConnection, "SELECT concat(firstName, ' ', lastName) as 'name' FROM users WHERE username='$this->username'");
        $row = mysqli_fetch_array($query);
        return $row['name'];
    }
    
    public function getUserEmail() {
        $query = mysqli_query($this->dBConnection, "SELECT email FROM users WHERE username='$this->username'");
        $row = mysqli_fetch_array($query);
        return $row['email'];
    }
}

?>