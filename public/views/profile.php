<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/302c390f8c.js" crossorigin="anonymous"></script>

</head>
<body>
<?php include 'navbar.php'?>

<div class="container">
    <div class = "profile">
        <div class="avatar">
        <p>Profil</p>
        <img src="public/img/user.svg">
        </div>
        <div class = "options">
        <button class="option">Dane osobowe</button>
        <button class="option">Statystyki</button>
        <button class="option">Zarządzaj książkami</button>
        <button class="option">Zarządzaj kontem</button>
        </div>
    </div>
    <div    class="user_data">
        <p>Dane osobowe</p>
        <div    class = data>
            <p>Imię:<?= $user->getName() ?></p>
            <p>Nazwisko:<?= $user->getSurname() ?></p>
            <p>Nr tel: <?php
                $phone = $user->getPhone();
                if(isset($phone)) {
                    echo $user->getPhone();
                }
                else echo "brak" ?></p>
        </div>
    </div>
</div>
</body>
</html>