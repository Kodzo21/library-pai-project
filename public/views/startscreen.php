<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/startscreen.css">
</head>
<body>
<div class="background">
    <div class="container">
        <div class="logo">
            <img class="image" src="public/img/logo.svg">
            <a href="login" class="menu-button">Zaloguj sie</a>
            <a href="register" class="menu-button"> Zarejestruj sie</a>
        </div>
        <div class="books">
            <p>Najpopularniejsze</p>
            <div class="prop">
                <?php
                foreach ($books as $book): ?>
                    <div id="pop-<?= $book->getID(); ?>">
                        <img src="public/uploads/<?= $book->getImage(); ?>">
                        <div>
                            <h4><?= $book->getTitle(); ?></h4>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>