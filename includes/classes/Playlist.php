<?php 
class Playlist {

    private $dBConnection;
    private $id;
    private $name;
    private $owner;


    public function __construct($dBConnection, $data)
    {

        if(!is_array($data)) {
            $query = mysqli_query($dBConnection, "SELECT * FROM playlists WHERE id='$data'");
            $data = mysqli_fetch_array($query);
        }

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

    public function getNumberOfSongs() {
        $query = mysqli_query($this->dBConnection, "SELECT songid FROM playlistSongs WHERE playlistId='$this->id'");
        return mysqli_num_rows($query);
    }

    public function getPlaylistSongIds() {
        $query = mysqli_query($this->dBConnection, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");

        $array = array();

        while($row = mysqli_fetch_array($query)) {
            array_push($array, $row['songId']);
        }

        return $array;
    }
    
    
}
?>