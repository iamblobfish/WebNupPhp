document.addEventListener("DOMContentLoaded", () => {
    const itemId = 1; // Replace "1" with the ID of the item you want to fetch
    fetch(`/get_item/${itemId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Item not found');
            }
            return response.json();
        })
        .then(data => {
            // Process the data here and display the item details on the webpage
            console.log(data.item); // Example: log the item details to the console
        })
        .catch(error => {
            console.error("Error fetching item:", error.message);
        });
});