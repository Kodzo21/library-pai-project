<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>REGISTER PAGE</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script defer="defer" type="text/javascript" src="./public/js/script.js" ></script>
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
<div class="container">
    <div class="logo">
        <img class="image" src="public/img/logo.svg">
    </div>
    <div class="login-container">
        <form class="login-form" action="login" method= "post">
            ZAREJESTRUJ
            <div class="message">
                <?php if (isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <input name="phone" type="text" placeholder="phone">
            <button class="btn-login" type="submit">REGISTER</button>
        </form>
    </div>
</div>
</body>
</html>