// JavaScript for the item page interactivity
const itemElements = document.getElementsByClassName("items");
console.log(itemElements)

// Loop through the elements and extract their ids
for (let i = 0; i < itemElements.length; i++) {
    const itemId = itemElements[i].id;
    console.log(itemId)
    if (itemId) {
        const item = document.getElementById(itemId);
        item.addEventListener('click', () => {
            sessionStorage.setItem('Category', itemId)
            console.log(sessionStorage.getItem('Category'))
            sessionStorage.removeItem('searchQuery')

            window.location.href = `/search?category=${encodeURIComponent(itemId)}`
        });
    }
}