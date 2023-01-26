<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
    <script src="https://kit.fontawesome.com/302c390f8c.js" crossorigin="anonymous"></script>
    <script type = "text/javascript" src="./public/js/search.js" defer="defer"></script>
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
                <input id="bar" type="text" placeholder="search books">
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
            <div id="<?= $book->getID();?>">
                <h2><?=$book->getTitle();?></h2>
                <p><?=$book->getDescription();?></p>
                <div class="social-section">
                    <i class="fa-regular fa-heart"></i><?= $book->getLike();?>
                    <i class="fa-solid fa-heart-crack"></i><?=$book->getDislike();?>
                </div>
                <button>Rezerwuj</button>
            </div>
        </div>
        <?php endforeach; ?>
    </section>



</main>


</div>
</body>
</html>

<template id="book_template">
    <div>
        <img src=""">
        <div>
            <h2>title</h2>
            <p>description</p>
            <div class="social-section">
                <i class="fa-regular fa-heart"></i>
                <i class="fa-solid fa-heart-crack"></i>
            </div>
            <button>Rezerwuj</button>
        </div>
    </div>
</template>