fetch("../templates/header.html")
    .then(response => response.text())
    .then(data => {
        // Insert the header content into the div with class "background-image"
        document.querySelector(".background-image").insertAdjacentHTML("afterbegin", data);
    });

fetch("../templates/footer.html")
    .then(response => response.text())
    .then(data => {
        // Insert the footer content at the end of the div with class "background-image"
        document.querySelector(".background-image").insertAdjacentHTML("beforeend", data);
    });