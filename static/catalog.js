// JavaScript for the item page interactivity
const itemElements = document.getElementsByClassName("item");


// Loop through the elements and extract their ids
for (let i = 0; i < itemElements.length; i++) {
    const itemId = itemElements[i].id;
    if (itemId) {
        const item = document.getElementById(itemId);
        item.addEventListener('click', (event) => {
            if (event.target.classList.contains('important-button')) {
                let itemList = JSON.parse(sessionStorage.getItem('itemList')) || [];
                itemList.push(itemId);
                console.log(itemList)
                sessionStorage.setItem('itemList', JSON.stringify(itemList));
            } else {
                sessionStorage.setItem('ItemId', itemId);
                console.log(sessionStorage.getItem('ItemId'));
                // sessionStorage.removeItem('Search')
                window.location.href = `/item?id=${encodeURIComponent(itemId)}`;
            }
        });
    }
}