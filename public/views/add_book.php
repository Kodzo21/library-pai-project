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
        <h1 id="upload">Upload</h1>
        <section class="book-form">
            <form action="addBook" method="post" enctype="multipart/form-data">
                <div class="messages">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
                </div>
                <input name="title" type="text" placeholder="title">
                <textarea name="description" rows="5" placeholder="description"></textarea>
                <input type="file" name="file">
                <button class="menu-button" type="submit">Send</button>
            </form>
        </section>


    </main>


</div>
</body>
</html>