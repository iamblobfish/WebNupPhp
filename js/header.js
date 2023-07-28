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

function switchLogin(){
    window.location.href = "/login";
}

function switchProfile(){
    window.location.href = "/profile";
}


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

document.addEventListener("DOMContentLoaded", function () {
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






