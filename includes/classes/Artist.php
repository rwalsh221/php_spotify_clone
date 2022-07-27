<?php 

class Artist {

    private $dBConnection;
    private $id;

    public function __construct($dBConnection, $id)
    {
        $this->dBConnection = $dBConnection;
        $this->id = $id;

    }

    public function getName() {
        $artistQuery = mysqli_query($this->dBConnection, "SELECT name FROM artists WHERE id='$this->id'");
        $artist = mysqli_fetch_array($artistQuery);
        return $artist['name'];
    }

    public function getSongIds() {
        $query = mysqli_query($this->dBConnection, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays ASC");

        $array = array();

        while($row = mysqli_fetch_array($query)) {
            array_push($array, $row['id']);
        }

        return $array;
    }
    
}
?>