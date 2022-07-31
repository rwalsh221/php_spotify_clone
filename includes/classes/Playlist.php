<?php 
class Playlist {

    private $dBConnection;
    private $id;
    private $name;
    private $owner;


    public function __construct($dBConnection, $data)
    {
        $this->dBConnection = $dBConnection;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];

    }

    public function getPlaylistId() {
        return $this->id;
    }

    public function getPlaylistName() {
        return $this->name;
    }

    public function getPlaylistOwner() {
        return $this->owner;
    }
    
    
}
?>