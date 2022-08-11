<?php 
include __DIR__ . '/../config.php';
include __DIR__ . '/../classes/User.php';
$userLoggedIn = $_SESSION['userLoggedIn'];
$user = new User($dBConnection, $userLoggedIn); 
?>

<nav class="nav-bar">
    <ul>
        <li class="nav-logo nav-link" role="link" tabindex="0" onclick="openPage('includes/html/albumList.php')"><ion-icon class="nav-link" name="radio-sharp"></ion-icon></li>
        <li class="nav-search-form">
            <button onclick="openPage('includes/html/searchContent.php')">search<ion-icon name="search-outline"></ion-icon></button>
        </li>
        <li class="nav-link"><span role="link" tabindex="0" onclick="openPage('includes/html/albumList.php')">browse</span></li>
        <li class="nav-link"><span role="link" tabindex="0" onclick="openPage('includes/html/yourMusicContent.php')">your music</span></li>
        <li class="nav-link"><span role="link" tabindex="0" onclick="openPage('includes/html/userContent.php')"><?php echo $user->getFirstNameLastName() ?></span></li>
    </ul>
</nav>