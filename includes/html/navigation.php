<nav class="nav-bar">
    <ul>
        <li class="nav-logo nav-link" role="link" tabindex="0" onclick="openPage('includes/html/albumList.php')"><ion-icon class="nav-link" name="radio-sharp"></ion-icon></li>
        <li class="nav-search-form">
            <form id="nav-form" action="index.php" method="post">
                <div class="nav-search-form__container">
                    <label for="nav-search"></label>
                    <input type="text" placeholder="Search" name="nav-search">
                    <button type="submit" id="nav-search__btn"><span class="nav-search-form__icon"><ion-icon name="search-outline"></ion-icon></span></button>
                </div>
            </form>
        </li>
        <li class="nav-link"><span role="link" tabindex="0" onclick="openPage('includes/html/browse.php')">browse</span></li>
        <li class="nav-link"><span role="link" tabindex="0" onclick="openPage('includes/html/yourMusic.php')">your music</span></li>
        <li class="nav-link"><span role="link" tabindex="0" onclick="openPage('includes/html/profile.php')">bunk moreland</span></li>
    </ul>
</nav>