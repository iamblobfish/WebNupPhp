function switchMain() {
    window.location.href = "/";
}

function clear() {
    document.getElementById('search_input').value = ""
}
document.getElementById("clear").addEventListener("click", clear)


document.getElementById("cart").addEventListener("click", function (){
    let itemList =JSON.parse(sessionStorage.getItem('itemList'));
    window.location.href = `/cart?ids=${encodeURIComponent([...new Set(itemList)].toString())}`
})


function switchSearch() {
    let searchQuery = document.getElementById('search_input').value;

    if (searchQuery === null || searchQuery === undefined) {
        searchQuery = "";
        document.getElementById('search').value = "";
    }

    // Store the searchQuery in sessionStorage
    console.log("SearchQuery on add: "+ searchQuery)
    sessionStorage.setItem('searchQuery', searchQuery);
    sessionStorage.removeItem('Category')

    window.location.href =`/search?search=${encodeURIComponent(searchQuery)}`;
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

document.addEventListener("DOMContentLoaded", function () {
    if (logedin === "true") {
        imageElement.src = "../static/images/profile.svg";
    } else {
        console.log(logedin)
        imageElement.src = "../static/images/sign-in.svg";
    }
    let searchQuery = sessionStorage.getItem('searchQuery');
    console.log("SearchQuery on load: "+ searchQuery)

    if (searchQuery) {
        // Set the value of the search input to the stored searchQuery
        document.getElementById('search_input').value = searchQuery;

        // Perform the search request using the stored searchQuery
        fetch(`/search?search=${encodeURIComponent(searchQuery)}`)
            .then(data => {
                // Process the search results (data) here
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    let category = sessionStorage.getItem('Category');
    console.log("SearchQuery on load: "+ searchQuery)

    if (category) {
        // Set the value of the search input to the stored searchQuery
        document.getElementById('search_input').value = "";

        // Perform the search request using the stored searchQuery
        fetch(`/search?category=${encodeURIComponent(category)}`)
            .then(data => {
                // Process the search results (data) here
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

});

imageElement.addEventListener("click", function () {
    if (logedin === "true") {
        window.location.href = "/profile";
    } else {
        window.location.href = "/login";
    }
})




