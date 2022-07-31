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

    
    
}

?>