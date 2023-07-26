document.addEventListener("DOMContentLoaded", function () {
    let itemList = JSON.parse(sessionStorage.getItem('itemList'));
    console.log(itemList)

    if (itemList) {
        const data = {
            data: itemList
        };

        // Perform the search request using the stored searchQuery
        fetch('/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(r => r);

        fetch('/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(r => r);
    }

});