<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/books.css">
    <link rel="stylesheet" type="text/css" href="public/css/prof.css">
    <script src="https://kit.fontawesome.com/302c390f8c.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="background">
    <?php include "navbar.php" ?>
    <div class="base-container">
        <main>
            <h1 id="upload">Upload</h1>
            <section class="book-form">
                <form action="addBook" method="POST" enctype="multipart/form-data">
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
                    <select class="sel" name = "category">
                        <?php
                        foreach ($categories as $category):?>
                            <option value="<?= $category->getId();?>"><?= $category->getCategory(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="sel" name = "author">
                        <?php
                        foreach ($authors as $author):?>
                        <option value="<?= $author->getId();?>"><?= $author->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="free_books_number" type="number" placeholder="Books number">
                    <input type="file" name="file">
                    <button class="btn-login" type="submit">Send</button>
                </form>
            </section>


        </main>


    </div>
</div>
</body>
</html>