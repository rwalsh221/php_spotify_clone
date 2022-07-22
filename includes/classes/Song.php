<?php 

    class Song {

        private $dBConnection;
        private $id;
        private $mysqliData;
        private $songTitle;
        private $artistId;
        private $albumId;
        private $genre;
        private $duration;
        private $songFilePath;

        public function __construct($dBConnection, $id)
        {
            $this->dBConnection = $dBConnection;
            $this->id = $id;

            $query = mysqli_query($this->dBConnection, "SELECT * FROM songs WHERE id='$this->id'");
            $this->mysqliData = mysqli_fetch_array($query);

            $this->songTitle = $this->mysqliData['title'];
            $this->artistId = $this->mysqliData['artist'];
            $this->albumId = $this->mysqliData['album'];
            $this->genre = $this->mysqliData['genre'];
            $this->duration = $this->mysqliData['duration'];
            $this->songFilePath = $this->mysqliData['path'];
        }

        public function getSongTitle() {
            return $this->songTitle;
        }

        public function getSongId() {
            return $this->id;
        }

        public function getArtist() {
            return new Artist($this->dBConnection, $this->artistId);
        }
        
        public function getAlbum() {
            return new Album($this->dBConnection, $this->albumId);
        }
        
        public function getGenre() {
            return $this->genre;
        }
        
        public function getDuration() {
            return $this->duration;
        }
        
        public function getSongFilePath() {
            return $this->songFilePath;
        }

        public function getMysqliData() {
            return $this->mysqliData;
        }


    }
?>