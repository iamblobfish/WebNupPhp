document.addEventListener("DOMContentLoaded", () => {
    const itemId = sessionStorage.getItem('ItemId');
    console.log(itemId)

    if (itemId) {
        // Perform the search request using the stored searchQuery
        fetch(`/item?id=${encodeURIComponent(itemId)}`)
            .then(data => {
                // Process the search results (data) here
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});


