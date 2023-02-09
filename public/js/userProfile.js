const manageButton = document.getElementById('manage');
const data = document.querySelector('.user_data')

function createContent(clone, content) {
    const list = clone.querySelector(".data-list")
    let li = document.createElement('li');
    li.id=content.id;
    //co wyswietlac w linijce
    li.innerHTML = "Tytuł: " + content.title + ", Data wypożyczenia: " + content.start_time + ", Zwrot do: " + content.end_time;
    list.appendChild(li);
    let returnButton = document.createElement("button");
    returnButton.className="return-button";
    returnButton.innerHTML = "Zwróć książkę";
    list.appendChild(returnButton);
}

function loadContent(content) {
    const template = document.querySelector("#data-template");
    const clone = template.content.cloneNode(true);
    content.forEach(ct => {
        createContent(clone,ct);
    });
    data.appendChild(clone);

    buttons = data.querySelectorAll('.return-button');
    buttons.forEach(button =>{
        button.addEventListener('click',function(event){
            btn = this;
            const li = btn.previousElementSibling;
            let id = li.getAttribute("id");
            fetch(`/returnBook/${id}`)
                .then(function() {
                    btn.remove();
                    li.remove();
                });
        });
    });
}




manageButton.addEventListener('click',function (event){
    event.preventDefault();
    fetch("/manage", {
        method: "GET",
        headers: {'Content-Type': 'application/json'},
    }).then(function (response) {
        return response.json();
    }).then(function (content) {
        data.innerHTML = "";
        console.log(content);
        loadContent(content);
    })
});