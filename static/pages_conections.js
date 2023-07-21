// Pages connections

// Get a reference to the button element
const sendLink = document.getElementById("sendLink");
const fgtPassword = document.getElementById("fgtPassword");
// const guestMode = document.getElementById("guestMode");
const loginBtn = document.getElementById("loginBtn");
// Add a click event listener to the button
fgtPassword.addEventListener("click",
    function () {
        window.location.href = "../templates/reset.html";
    });
loginBtn.addEventListener("click",
    function () {
        window.location.href = "../templates/search.html";
    });
sendLink.addEventListener("click",
    function () {
        window.history.back();
    })