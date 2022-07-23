<nav class="nav-bar">
    <ul>
        <li class="nav-logo" onclick="openPage('index.php')"><ion-icon name="radio-sharp"></ion-icon></li>
        <li class="nav-search-form">
            <form id="nav-form" action="index.php" method="post">
                <div class="nav-search-form__container">
                    <label for="nav-search"></label>
                    <input type="text" placeholder="Search" name="nav-search">
                    <button type="submit" id="nav-search__btn"><span class="nav-search-form__icon"><ion-icon name="search-outline"></ion-icon></span></button>
                </div>
            </form>
        </li>
        <li class="nav-link"><a href="/">browse</a></li>
        <li class="nav-link"><a href="/">your music</a></li>
        <li class="nav-link"><a href="/">bunk moreland</a></li>
    </ul>
</nav>