<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/prof.css">
    <script src="https://kit.fontawesome.com/302c390f8c.js" crossorigin="anonymous"></script>
    <script src="./public/js/userProfile.js" defer="defer"></script>
    <script type="text/javascript" src="./public/js/bar.js" defer="defer"></script>

</head>
<body>
<div class="background">
    <?php include 'navbar.php' ?>

    <div class="container">
        <div class="profile">
            <div class="avatar">
                <p>Profil</p>
                <img src="public/img/user.svg">
            </div>
            <div class="options">
                <a class="option" href="profile">Dane osobowe</a>
                <button class="option">Statystyki</button>
                <button id="manage" class="option">Zarządzaj książkami</button>
                <button class="option">Zarządzaj kontem</button>
            </div>
        </div>
        <div class="user_data">
            <p>Dane osobowe</p>
            <div class=data>
                <p>Imię:<?= $user->getName() ?></p>
                <p>Nazwisko:<?= $user->getSurname() ?></p>
                <p>Nr tel: <?php
                    $phone = $user->getPhone();
                    if (isset($phone)) {
                        echo $user->getPhone();
                    } else echo "brak" ?></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<template id="data-template">
    <p>Zarządzanie książkami</p>
    <div class="data">
        <ul class="data-list">
        </ul>
    </div>
</template>