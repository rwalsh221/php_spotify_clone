
<div class="album-list">
    <h1 class="heading__primary album-list__heading">You Might Also Like</h1>

    <?php 
    include __DIR__ . '/../config.php'; 

        $albumQuery = mysqli_query($dBConnection, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
        
        while($dbRow = mysqli_fetch_array($albumQuery)) {
            echo "<div class='album-card'>
                    <span role='link' tabindex='0' onclick='openPage(\"includes/html/albumContent.php?id=" . $dbRow['id'] . "\")'>
                        <img class='album-image' src='" . $dbRow['artworkPath'] . "'>
                        <p class='album-title'>" . $dbRow['title'] . "</p>
                    </span>
                </div>";
        }
    ?>
</div>
