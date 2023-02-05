<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>

<div class="container">
    <div class="logo">
        <img class="image" src="public/img/logo.svg">
    </div>
    <div class="login-container">
        <form class="login-form" action="login" method= "post">
            ZALOGUJ
            <div class="message">
                <?php if (isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input type="password" name="password" placeholder="password">
            <button class = "btn-login" type="submit">OK</button>
        </form>
    </div>
</div>
</body>
</html>