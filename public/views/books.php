<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <base href="http://localhost:8080/">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
    <script src="https://kit.fontawesome.com/302c390f8c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer="defer"></script>
    <script id="stat" type="text/javascript" src="./public/js/stats.js" defer="defer"></script>
    <script type="text/javascript" src="./public/js/bar.js" defer="defer"></script>
</head>
<body>
<div class="background">
    <?php include "navbar.php" ?>
    <div class="base-container">
        <main>
            <p id="category"><?= array_pop($books) ?></p>

            <section class="book-section">
                <?php
                foreach ($books as $book):?>
                    <div id="<?= $book->getID(); ?>">
                        <img src="public/uploads/<?= $book->getImage(); ?>">
                        <div>
                            <h2><?= $book->getTitle(); ?></h2>
                            <p><?= $book->getDescription(); ?></p>
                            <div class="social-section">
                                <button class="heart-button"><p><?= $book->getLike(); ?></p> <i
                                            class="fa-solid fa-heart"> </i></button>
                                <button class="broken-heart-button"><p> <?= $book->getDislike(); ?></p><i
                                            class="fa-solid fa-heart-crack"></i></button>
                            </div>
                            <form action="reserve" method="post">
                                <input type="hidden" name="book_id" value="<?php $id = $book->getID();
                                echo $id ?>">
                                <input class="reserve-button" type="submit" value="Reserve Book">
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>

            </section>

        </main>


    </div>
</div>
</body>
</html>

<template id="book_template">
    <div class="book-tile">
        <img src=""">
        <div>
            <h2>title</h2>
            <p>description</p>
            <div class="social-section">
                <button class="heart-button"><p class="like">like</p> <i class="fa-solid fa-heart"> </i></button>
                <button class="broken-heart-button"><p class="dislike"> dislike </p><i
                            class="fa-solid fa-heart-crack"></i></button>
            </div>
            <button>Rezerwuj</button>
        </div>
    </div>
</template>