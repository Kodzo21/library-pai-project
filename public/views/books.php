<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="navbar-left">
            <ul>
                <li>
                    <a href="#" class="nav-button">Strona Główna</a>
                </li>
                <li>
                    <a href="#" class="nav-button">Kategorie</a>
                </li>
                <li>
                    <a href="#" class="nav-button">Najpopularniejsze</a>
                </li>
                <li>
                    <a href="#" class="nav-button">Nowości</a>
                </li>
            </ul>
        </div>
        <div class="search-bar">
            <form>
                <input type="text" placeholder="search books">
            </form>
        </div>
        </li>
        </ul>
    </nav>
</header>
<div class="base-container">
<main>
    <p id="category">Kategoria : Fantasy</p>
    <section class="book-section">
        <?php
        foreach ($books as $book):?>
        <div>
            <img src="public/uploads/<?=$book->getImage(); ?>">
            <div>
                <h2><?=$book->getTitle();?></h2>
                <p><?=$book->getDescription();?></p>
                <button>Rezerwuj</button>
            </div>
        </div>
        <?php endforeach; ?>
    </section>



</main>


</div>
</body>
</html>