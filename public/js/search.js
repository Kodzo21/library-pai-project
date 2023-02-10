const search = document.querySelector('input[placeholder="search books"]');
const bookContainer = document.querySelector('.book-section');

function createBook(book) {
    const template = document.querySelector("#book_template");
    const clone = template.content.cloneNode(true);
    const div = clone.querySelector(".book-tile")
    div.id = book.id;
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${book.image}`;

    const title = clone.querySelector("h2");
    title.innerHTML = book.title;
    const description = clone.querySelector("p");
    description.innerHTML = book.description;
    const like = clone.querySelector(".like");
    like.innerHTML = book.like;
    const dislike = clone.querySelector(".dislike");
    dislike.innerHTML = book.dislike;
    const btn = clone.querySelector(".setid");
    btn.value = book.id;

    bookContainer.appendChild(clone);
}

function loadBooks(books) {
    books.forEach(book => {
        createBook(book);
    });
    reloadButtons();
}

function reloadButtons(){
    const script = document.getElementById('stat');
    const parent = script.parentNode;
    parent.removeChild(script);
    const newScript = document.createElement('script');
    newScript.src = "public/js/stats.js";
    document.head.appendChild(newScript);
}

search.addEventListener("keyup", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
        const data = {search: this.value};
        fetch("/search", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data),

        }).then(function (response) {
            return response.json();
        }).then(function (books) {
            bookContainer.innerHTML = "";
            loadBooks(books);
        })
    }
})