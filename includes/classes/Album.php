<?php 

class Album {

    private $dBConnection;
    private $id;
    private $title;
    private $artistId;
    private $genre;
    private $artworkPath;

    public function __construct($dBConnection, $id)
    {
        $this->dBConnection = $dBConnection;
        $this->id = $id;

        $albumQuery = mysqli_query($this->dBConnection, "SELECT * FROM albums WHERE id='$this->id'");
        $album = mysqli_fetch_array($albumQuery);

        $this->title = $album['title'];
        $this->artistId = $album['artist'];
        $this->genre = $album['genre'];
        $this->artworkPath = $album['artworkPath'];
    }

    public function getTitle() {
        return $this->title;
    }

    public function getArtist() {
        return new Artist($this->dBConnection, $this->artistId);
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getArtworkPath() {
        return $this->artworkPath;
    }

    public function getNumberOfSongs() {
        $query = mysqli_query($this->dBConnection, "SELECT * FROM songs WHERE album='$this->id'");
        return mysqli_num_rows($query);
    }

    public function getSongIds() {
        $query = mysqli_query($this->dBConnection, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");

        $array = array();

        while($row = mysqli_fetch_array($query)) {
            array_push($array, $row['id']);
        }

        return $array;
    }

    
}
?>