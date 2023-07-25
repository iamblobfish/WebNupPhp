// JavaScript for the item page interactivity
const item = document.getElementsByClassName('item').item(0);
console.log(item.id)

// Handle quantity decrease button click
item.addEventListener('click',  () => {
    window.location.href = '/item'
});