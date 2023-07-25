function switchMain() {
    window.location.href = "/";
}

function switchSearch() {
    window.location.href = "/search";
}

function switchCategory() {
    window.location.href = "/category";
}

// Function to get the global variable from sessionStorage
function getGlobalVariable() {
  return sessionStorage.getItem('myGlobalVariable');
}


const imageElement = document.getElementById("profile");
let logedin = getGlobalVariable();

console.log(logedin)
console.log(logedin === "true")
document.addEventListener("DOMContentLoaded", function () {
    if (logedin === "true") {
        imageElement.src = "../static/images/profile.svg";
    } else{
        console.log(logedin)
        imageElement.src = "../static/images/sign-in.svg";
    }
});

imageElement.addEventListener("click", function () {
    if (logedin === "true") {
    } else {
        window.location.href = "/login";;
    }
});



