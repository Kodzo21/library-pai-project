<header>
    <nav class="navbar">
        <button class="menu-open"><i class="fa-solid fa-bars"></i></button>
        <div class="sidebar" id="sidebar">
            <ul>
                <li>
                    <button class="close-button" id="close">x</button>
                </li>
                <li>
                    <a href="books" class="nav-button">Strona Główna</a>
                </li>
                <li>
                    <div class="dropdown">
                        <a href="books" class="nav-button" id="options1">Kategorie</a>
                        <div class="category-list">
                            <a href="books/fantasy">Fantasy</a>
                            <a href="books/science-fiction">Science fiction</a>
                            <a href="books/kryminal">Kryminał</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="books/popular" class="nav-button">Najpopularniejsze</a>
                </li>
                <li>
                    <a href="books" class="nav-button">Nowości</a>
                </li>
            </ul>
        </div>
        <div class="navbar-left">
            <ul>
                <li>
                    <a href="books" class="nav-button">Strona Główna</a>
                </li>
                <li>
                    <div class="dropdown">
                        <a href="books" class="nav-button" id="options">Kategorie</a>
                        <div class="category-list">
                            <a href="books/fantasy">Fantasy</a>
                            <a href="books/science-fiction">Science fiction</a>
                            <a href="books/kryminal">Kryminał</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="books/popular" class="nav-button">Najpopularniejsze</a>
                </li>
                <li>
                    <a href="books" class="nav-button">Nowości</a>
                </li>
            </ul>
        </div>
        <div class="search-bar">
            <input id="bar" type="text" placeholder="search books">
        </div>
        <div class="profile-buttons">
            <form action="logout" method="post">
                <button type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
            <a href = "profile" class = "user"><i class="fa-regular fa-user"></i></a>
            <?php if($_SESSION['role']==="admin") {echo '<a href = "addBook" class = "user"><i class="fa-solid fa-upload"></i></a>';}  ?>
        </div>

    </nav>
</header>