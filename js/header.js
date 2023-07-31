function clear() {
    document.getElementById('search_input').value = ""
}

document.getElementById("clear").addEventListener("click", clear)

document.addEventListener("DOMContentLoaded", function () {
    let searchQuery = sessionStorage.getItem('searchQuery');
    console.log("SearchQuery on load: " + searchQuery)

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
    console.log("SearchQuery on load: " + searchQuery)

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






