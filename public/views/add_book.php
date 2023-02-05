<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
</head>
<body>
<?php include "navbar.php"?>
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
                <input name="isbn" type="text" placeholder="isbn">
                <input name ="free_books_number" type="number" placeholder="Books number">
                <input type="file" name="file">
                <button class="menu-button" type="submit">Send</button>
            </form>
        </section>


    </main>


</div>
</body>
</html>