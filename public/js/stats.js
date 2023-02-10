
if(!window.likeButtons)
    window.likeButtons = document.querySelectorAll(".heart-button");
else likeButtons=document.querySelectorAll(".heart-button");

if(!window.dislikeButtons)
    window.dislikeButtons = document.querySelectorAll(".broken-heart-button");
else dislikeButtons = document.querySelectorAll(".broken-heart-button");

function giveLike() {
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/like/${id}`)
        .then(function () {
            const txt = likes.firstElementChild;
            txt.innerHTML = parseInt(txt.innerHTML) + 1;
        })
}

function giveDislike() {
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/dislike/${id}`)
        .then(function () {
            const txt=dislikes.firstElementChild;
            txt.innerHTML = parseInt(txt.innerHTML) + 1;
        })
}

likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));